<?php
declare(strict_types=1);

function security_headers(): void {
  header('X-Content-Type-Options: nosniff');
  header('X-Frame-Options: SAMEORIGIN');
  header('Referrer-Policy: strict-origin-when-cross-origin');
  header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

  if (is_https()) {
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
  }

  // Minimal CSP (tighten per project)
  header("Content-Security-Policy: default-src 'self'; img-src 'self' data:; style-src 'self' 'unsafe-inline'; script-src 'self' 'unsafe-inline'");
}

function csrf_token(): string {
  if (!isset($_SESSION['_csrf'])) {
    $seed = (string)config('security.csrf_key', 'change-me');
    $_SESSION['_csrf'] = hash('sha256', $seed . '|' . bin2hex(random_bytes(16)));
  }
  return (string)$_SESSION['_csrf'];
}

function csrf_field(): string {
  return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function csrf_verify(): void {
  if (request_method() !== 'POST') return;
  $sent = (string)($_POST['_csrf'] ?? '');
  if (!hash_equals(csrf_token(), $sent)) {
    http_response_code(419);
    echo 'CSRF token mismatch.';
    exit;
  }
}
