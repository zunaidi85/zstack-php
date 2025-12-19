<?php
declare(strict_types=1);

namespace Controllers;

class HomeController extends BaseController {
  public function index(): void {
    \seo_set([
      'title' => 'Home — ' . \config('app.name'),
      'description' => 'Z-Stack v1.2 running.',
    ]);

    \view('home', [
      'appName' => \config('app.name'),
      'userId' => \auth_user_id(),
    ]);
  }
}
