<?php
declare(strict_types=1);

function e(string $s): string {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function is_https(): bool {
  if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') return true;
  if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') return true;
  return false;
}

function base_url(string $path = ''): string {
  $base = (string)config('app.url', '');
  if ($base !== '') return $base . ($path ? '/' . ltrim($path, '/') : '');
  $scheme = is_https() ? 'https' : 'http';
  $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
  return $scheme . '://' . $host . ($path ? '/' . ltrim($path, '/') : '');
}

function url(string $path = ''): string {
  return '/' . ltrim($path, '/');
}

function request_method(): string {
  return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
}

function request_input(string $key, mixed $default = null): mixed {
  return $_POST[$key] ?? $_GET[$key] ?? $default;
}

function flash_set(string $key, string $message): void {
  $_SESSION['_flash'][$key] = $message;
}

function flash_get(string $key): ?string {
  $msg = $_SESSION['_flash'][$key] ?? null;
  unset($_SESSION['_flash'][$key]);
  return $msg;
}

function logger(string $level, string $message, array $context = []): void {
  $dir = dirname(__DIR__) . '/storage/logs';
  if (!is_dir($dir)) @mkdir($dir, 0775, true);

  $file = $dir . '/app-' . date('Y-m-d') . '.log';
  $line = sprintf(
    "[%s] %s: %s %s\n",
    date('c'),
    strtoupper($level),
    $message,
    $context ? json_encode($context, JSON_UNESCAPED_SLASHES) : ''
  );
  @file_put_contents($file, $line, FILE_APPEND);
}

// Tiny file cache
function cache_path(string $key): string {
  $safe = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $key);
  return dirname(__DIR__) . "/storage/cache/{$safe}.cache";
}

function cache_get(string $key): mixed {
  $path = cache_path($key);
  if (!is_file($path)) return null;
  $raw = @file_get_contents($path);
  if ($raw === false || $raw === '') return null;

  $data = @unserialize($raw);
  if (!is_array($data) || !isset($data['exp'])) return null;

  if ($data['exp'] !== 0 && time() > (int)$data['exp']) {
    @unlink($path);
    return null;
  }
  return $data['val'] ?? null;
}

function cache_set(string $key, mixed $value, int $ttl = 300): void {
  $dir = dirname(__DIR__) . '/storage/cache';
  if (!is_dir($dir)) @mkdir($dir, 0775, true);

  $exp = $ttl > 0 ? time() + $ttl : 0;
  $data = ['exp' => $exp, 'val' => $value];
  @file_put_contents(cache_path($key), serialize($data));
}

// Routing
function route_match(array $routes, string $method, string $uri): array {
  foreach ($routes as $r) {
    [$m, $path, $handler] = $r;
    if (strtoupper((string)$m) !== $method) continue;

    $params = [];
    $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', (string)$path);
    $pattern = '#^' . $pattern . '$#';

    if (preg_match($pattern, $uri, $matches)) {
      foreach ($matches as $k => $v) {
        if (is_string($k)) $params[$k] = $v;
      }
      return [$handler, $params];
    }
  }
  return [null, []];
}

function dispatch(mixed $handler, array $params = []): mixed {
  if (is_callable($handler)) return $handler($params);

  if (is_array($handler) && count($handler) === 2) {
    [$class, $method] = $handler;
    $fqcn = 'Controllers\\' . $class;

    if (!class_exists($fqcn)) throw new RuntimeException("Controller not found: $fqcn");
    $obj = new $fqcn();

    if (!method_exists($obj, $method)) throw new RuntimeException("Method not found: $fqcn::$method");
    return $obj->$method($params);
  }

  throw new RuntimeException('Invalid handler');
}
