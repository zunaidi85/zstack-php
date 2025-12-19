<?php
declare(strict_types=1);

function validate(array $data, array $rules): array {
  $errors = [];

  foreach ($rules as $field => $ruleStr) {
    $val = $data[$field] ?? null;
    $ruleList = array_filter(array_map('trim', explode('|', (string)$ruleStr)));

    foreach ($ruleList as $rule) {
      [$name, $arg] = array_pad(explode(':', $rule, 2), 2, null);

      if ($name === 'required') {
        if ($val === null || $val === '') $errors[$field][] = 'required';
      }

      if ($name === 'email' && $val !== null && $val !== '') {
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) $errors[$field][] = 'email';
      }

      if ($name === 'min' && $val !== null && $arg !== null) {
        if (mb_strlen((string)$val) < (int)$arg) $errors[$field][] = "min:$arg";
      }
    }
  }

  return $errors;
}
