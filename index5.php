<?php
define('DS', DIRECTORY_SEPARATOR);
define('LOG', __DIR__ . DS . 'log' . DS);

// $file = LOG . 'php' . DS . 'php.log';
$file = 'note.md';

$pattern = "/^[1-9]*[0-9]$/i";
$subject = file_get_contents($file);
$rs = preg_match_all($pattern, $subject, $match);

print_r($match);
