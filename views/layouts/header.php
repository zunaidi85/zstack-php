<?php
// Variables: $seo, $flash_error, $flash_success
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?= e($seo['title'] ?? config('app.name')) ?></title>
  <meta name="description" content="<?= e($seo['description'] ?? '') ?>">
  <meta name="robots" content="<?= e($seo['robots'] ?? 'index,follow') ?>">
  <link rel="canonical" href="<?= e($seo['canonical'] ?? base_url('/')) ?>">

  <meta property="og:title" content="<?= e($seo['title'] ?? config('app.name')) ?>">
  <meta property="og:description" content="<?= e($seo['description'] ?? '') ?>">
  <meta property="og:url" content="<?= e($seo['canonical'] ?? base_url('/')) ?>">
  <?php if (!empty($seo['og_image'])): ?>
    <meta property="og:image" content="<?= e($seo['og_image']) ?>">
  <?php endif; ?>

  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;margin:0;background:#0b0f14;color:#e8eef6}
    .wrap{max-width:980px;margin:0 auto;padding:24px}
    .card{background:#111827;border:1px solid #1f2937;border-radius:14px;padding:18px}
    a{color:#93c5fd}
    input,button{padding:10px;border-radius:10px;border:1px solid #334155;background:#0b1220;color:#e8eef6}
    button{cursor:pointer}
    .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px}
    .badge{font-size:12px;color:#9ca3af}
    .flash{margin:12px 0;padding:10px;border-radius:12px}
    .flash.err{background:#2a1111;border:1px solid #7f1d1d}
    .flash.ok{background:#102a14;border:1px solid #166534}
    code{background:#0b1220;border:1px solid #1f2937;padding:2px 6px;border-radius:8px}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <div>
        <strong><?= e(config('app.name')) ?></strong>
        <div class="badge">Z-Stack v1.2</div>
      </div>
      <div>
        <a href="<?= e(url('/')) ?>">Home</a>
        &nbsp;|&nbsp;
        <?php if (auth_check()): ?>
          <a href="<?= e(url('/logout')) ?>">Logout</a>
        <?php else: ?>
          <a href="<?= e(url('/login')) ?>">Login</a>
        <?php endif; ?>
      </div>
    </div>

    <?php if (!empty($flash_error)): ?>
      <div class="flash err"><?= e($flash_error) ?></div>
    <?php endif; ?>
    <?php if (!empty($flash_success)): ?>
      <div class="flash ok"><?= e($flash_success) ?></div>
    <?php endif; ?>
