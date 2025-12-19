<?php
declare(strict_types=1);

function session_start_secure(): void {
  if (session_status() === PHP_SESSION_ACTIVE) return;

  session_name((string)config('session.name', 'ZSTACKSESSID'));

  ini_set('session.use_strict_mode', '1');
  ini_set('session.use_only_cookies', '1');

  $params = session_get_cookie_params();
  session_set_cookie_params([
    'lifetime' => 0,
    'path' => $params['path'] ?? '/',
    'domain' => $params['domain'] ?? '',
    'secure' => is_https(),
    'httponly' => true,
    'samesite' => 'Lax',
  ]);

  session_start();

  // idle timeout (30 min)
  $idle = 1800;
  $now = time();
  if (!isset($_SESSION['_last'])) $_SESSION['_last'] = $now;

  if (($now - (int)$_SESSION['_last']) > $idle) {
    session_unset();
    session_destroy();
    session_start();
  }
  $_SESSION['_last'] = $now;
}
