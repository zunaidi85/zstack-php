<?php
declare(strict_types=1);

function view(string $page, array $data = [], int $status = 200): void {
  http_response_code($status);

  $seo = seo_get();
  $flash_error = flash_get('error');
  $flash_success = flash_get('success');

  extract($data, EXTR_SKIP);

  $base = dirname(__DIR__) . '/views';
  $pageFile = $base . '/pages/' . $page . '.php';

  if (!is_file($pageFile)) {
    echo 'View not found: ' . e($page);
    return;
  }

  include $base . '/layouts/header.php';
  include $pageFile;
  include $base . '/layouts/footer.php';
}

function json(mixed $data, int $status = 200): void {
  http_response_code($status);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

function redirect(string $to, int $status = 302): void {
  header('Location: ' . $to, true, $status);
  exit;
}
