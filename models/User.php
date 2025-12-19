<?php
declare(strict_types=1);

namespace Models;

class User extends BaseModel {
  public static function findByEmail(\PDO $pdo, string $email): ?array {
    $st = $pdo->prepare('SELECT id, email, password_hash FROM users WHERE email = ? LIMIT 1');
    $st->execute([$email]);
    $row = $st->fetch();
    return $row ?: null;
  }
}
