<?php
declare(strict_types=1);

$GLOBALS['ZSTACK_SEO'] = [
  'title' => (string)config('app.name', 'Z-Stack'),
  'description' => 'Minimal PHP framework.',
  'canonical' => null,
  'robots' => 'index,follow',
  'og_image' => null,
];

function seo_set(array $meta): void {
  $GLOBALS['ZSTACK_SEO'] = array_merge($GLOBALS['ZSTACK_SEO'], $meta);
}

function seo_get(): array {
  $seo = $GLOBALS['ZSTACK_SEO'] ?? [];
  if (empty($seo['canonical'])) {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $seo['canonical'] = base_url($path);
  }
  return $seo;
}
