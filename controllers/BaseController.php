<?php
declare(strict_types=1);

namespace Controllers;

class BaseController {
  protected ?\PDO $db;

  public function __construct() {
    $this->db = \db();
  }

  protected function requireAuth(): void {
    if (!\auth_check()) {
      \flash_set('error', 'Please login first.');
      \redirect(\url('/login'));
    }
  }
}
