<?php
declare(strict_types=1);

namespace Controllers;

use Models\User;

class AuthController extends BaseController {

  public function showLogin(): void {
    \seo_set(['title' => 'Login — ' . \config('app.name')]);
    \view('login');
  }

  public function login(): void {
    \csrf_verify();

    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    if (!\rate_hit("login_$ip", 12, 300)) {
      \flash_set('error', 'Too many attempts. Try again later.');
      \redirect(\url('/login'));
    }

    $email = (string)\request_input('email', '');
    $pass  = (string)\request_input('password', '');

    $errors = \validate(['email' => $email, 'password' => $pass], [
      'email' => 'required|email',
      'password' => 'required|min:6',
    ]);

    if ($errors) {
      \flash_set('error', 'Invalid input.');
      \redirect(\url('/login'));
    }

    $pdo = \db();
    if (!$pdo) {
      \flash_set('error', 'DB not configured. Set .env first.');
      \redirect(\url('/login'));
    }

    $user = User::findByEmail($pdo, $email);
    if (!$user || !password_verify($pass, $user['password_hash'])) {
      \flash_set('error', 'Wrong email or password.');
      \redirect(\url('/login'));
    }

    \auth_login((int)$user['id']);
    \flash_set('success', 'Welcome back!');
    \redirect(\url('/'));
  }

  public function logout(): void {
    \auth_logout();
    \flash_set('success', 'Logged out.');
    \redirect(\url('/'));
  }
}
