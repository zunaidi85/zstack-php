<?php
declare(strict_types=1);

$GLOBALS['ZSTACK_ENV'] = [];

// Tiny .env loader
$envFile = dirname(__DIR__) . '/.env';
if (is_file($envFile)) {
  $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || str_starts_with($line, '#')) continue;

    [$k, $v] = array_pad(explode('=', $line, 2), 2, '');
    $k = trim($k);
    $v = trim($v);

    // Strip surrounding quotes
    if ((str_starts_with($v, '"') && str_ends_with($v, '"')) ||
        (str_starts_with($v, "'") && str_ends_with($v, "'"))) {
      $v = substr($v, 1, -1);
    }

    $GLOBALS['ZSTACK_ENV'][$k] = $v;
  }
}

function env(string $key, mixed $default = null): mixed {
  return $GLOBALS['ZSTACK_ENV'][$key] ?? $default;
}

$appEnv = (string)env('APP_ENV', 'local');
$debugRaw = env('APP_DEBUG', null);

// If APP_DEBUG is not set, default debug=false in production, true otherwise.
if ($debugRaw === null || $debugRaw === '') {
  $appDebug = ($appEnv !== 'production');
} else {
  $appDebug = filter_var($debugRaw, FILTER_VALIDATE_BOOL);
}

$GLOBALS['ZSTACK_CONFIG'] = [
  'app' => [
    'name'  => (string)env('APP_NAME', 'Z-Stack'),
    'env'   => $appEnv,
    'debug' => $appDebug,
    'url'   => rtrim((string)env('APP_URL', ''), '/'),
  ],
  'security' => [
    'csrf_key' => (string)env('CSRF_KEY', 'change-me'),
  ],
  'session' => [
    'name' => (string)env('SESSION_NAME', 'ZSTACKSESSID'),
  ],
  'db' => [
    'host'    => (string)env('DB_HOST', ''),
    'name'    => (string)env('DB_NAME', ''),
    'user'    => (string)env('DB_USER', ''),
    'pass'    => (string)env('DB_PASS', ''),
    'charset' => (string)env('DB_CHARSET', 'utf8mb4'),
  ],
];

function config(string $key, mixed $default = null): mixed {
  $parts = explode('.', $key);
  $cur = $GLOBALS['ZSTACK_CONFIG'] ?? [];
  foreach ($parts as $p) {
    if (!is_array($cur) || !array_key_exists($p, $cur)) return $default;
    $cur = $cur[$p];
  }
  return $cur;
}
