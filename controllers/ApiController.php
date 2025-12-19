<?php
declare(strict_types=1);

namespace Controllers;

class ApiController extends BaseController {
  public function ping(): array {
    return [
      'ok' => true,
      'time' => date('c'),
      'app' => \config('app.name'),
    ];
  }
}
