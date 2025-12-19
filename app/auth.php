<?php
declare(strict_types=1);

function auth_check(): bool {
  return !empty($_SESSION['user_id']);
}

function auth_user_id(): ?int {
  return auth_check() ? (int)$_SESSION['user_id'] : null;
}

function auth_login(int $userId): void {
  $_SESSION['user_id'] = $userId;
  session_regenerate_id(true);
}

function auth_logout(): void {
  unset($_SESSION['user_id']);
  session_regenerate_id(true);
}
