<?php
declare(strict_types=1);

function rate_hit(string $key, int $max = 10, int $window = 300): bool {
  $k = 'rl_' . $key;
  $data = cache_get($k);

  if (!is_array($data)) {
    cache_set($k, ['count' => 1, 'start' => time()], $window);
    return true;
  }

  $start = (int)($data['start'] ?? time());
  $count = (int)($data['count'] ?? 0);

  if ((time() - $start) > $window) {
    cache_set($k, ['count' => 1, 'start' => time()], $window);
    return true;
  }

  $count++;
  $data['count'] = $count;
  cache_set($k, $data, $window);

  return $count <= $max;
}
