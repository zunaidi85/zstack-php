<?php
declare(strict_types=1);

return [
  ['GET',  '/',        ['HomeController', 'index']],
  ['GET',  '/login',   ['AuthController', 'showLogin']],
  ['POST', '/login',   ['AuthController', 'login']],
  ['GET',  '/logout',  ['AuthController', 'logout']],

  ['GET', '/robots.txt', function () {
    header('Content-Type: text/plain; charset=utf-8');
    echo "User-agent: *\nAllow: /\n";
  }],

  ['GET', '/sitemap.xml', function () {
    header('Content-Type: application/xml; charset=utf-8');
    $base = base_url('/');
    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    echo '<url><loc>' . e($base) . '</loc></url>';
    echo '</urlset>';
  }],
];
