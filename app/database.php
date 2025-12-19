<?php
declare(strict_types=1);

function db(): ?PDO {
  static $pdo = null;
  if ($pdo instanceof PDO) return $pdo;

  $host = (string)config('db.host', '');
  $name = (string)config('db.name', '');
  $user = (string)config('db.user', '');
  $pass = (string)config('db.pass', '');
  $charset = (string)config('db.charset', 'utf8mb4');

  // Allow running without DB (home page still works)
  if ($host === '' || $name === '' || $user === '') return null;

  $dsn = "mysql:host={$host};dbname={$name};charset={$charset}";
  $pdo = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
  ]);

  return $pdo;
}
