<?php
declare(strict_types=1);

require __DIR__ . '/../app/bootstrap.php';

$webRoutes = require __DIR__ . '/../routes/web.php';
$apiRoutes = require __DIR__ . '/../routes/api.php';
$routes = array_merge($webRoutes, $apiRoutes);

$method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($uri !== '/' && str_ends_with($uri, '/')) {
  $uri = rtrim($uri, '/');
}

[$handler, $params] = route_match($routes, $method, $uri);

if (!$handler) {
  view('error_404', ['path' => $uri], 404);
  exit;
}

try {
  $result = dispatch($handler, $params);

  // If controller returned array/object, output JSON by default
  if (is_array($result) || is_object($result)) {
    json($result);
  }
} catch (Throwable $e) {
  logger('error', 'Unhandled exception', [
    'message' => $e->getMessage(),
    'file' => $e->getFile(),
    'line' => $e->getLine()
  ]);

  if (config('app.debug')) {
    http_response_code(500);
    echo '<pre>' . e((string)$e) . '</pre>';
  } else {
    view('error_500', [], 500);
  }
}
