<?php

$arr = ['a'=>1, 'b'=>2, 'c'=>3];
$arr0 = ['a'=>4];
$r = array_diff_key($arr, $arr0);
print_r($r);
