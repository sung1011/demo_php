<?php

$arr = [
    ['k'=>3],
    ['k'=>1],
    ['k'=>5],
];

// $rs = array_multisort(array_column($arr, 'k'), SORT_ASC, $arr);
$tmp = array_column($arr, 'k');

$arr1 = [
    1, 3, 4, 2
];
$arr2 = [
    20, 40, 30, 10
];
array_multisort($arr1, SORT_DESC, $arr2);
print_r(get_defined_vars());
