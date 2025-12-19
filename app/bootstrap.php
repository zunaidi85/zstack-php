<?php
declare(strict_types=1);

// 1) Config + env loader
require __DIR__ . '/config.php';
require __DIR__ . '/helpers.php';

// 2) Session (secure)
require __DIR__ . '/session.php';
session_start_secure();

// 3) Security headers + CSRF
require __DIR__ . '/security.php';
security_headers();

// 4) Response helpers
require __DIR__ . '/response.php';

// 5) SEO helper
require __DIR__ . '/seo.php';

// 6) Auth + validation + rate limiter
require __DIR__ . '/auth.php';
require __DIR__ . '/validator.php';
require __DIR__ . '/rate_limiter.php';

// 7) Database helper (PDO)
require __DIR__ . '/database.php';

// 8) Minimal autoload for Controllers/ and Models/
spl_autoload_register(function (string $class): void {
  $map = [
    'Controllers\\' => __DIR__ . '/../controllers/',
    'Models\\'      => __DIR__ . '/../models/',
  ];

  foreach ($map as $prefix => $baseDir) {
    if (str_starts_with($class, $prefix)) {
      $rel = substr($class, strlen($prefix));
      $path = $baseDir . str_replace('\\', '/', $rel) . '.php';
      if (is_file($path)) require $path;
      return;
    }
  }
});
