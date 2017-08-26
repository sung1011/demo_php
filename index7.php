<?php

$arr1 = ['a', 'b', 'c'];
$arr2 = ['x', 'y', 'z'];


$cnt = count($arr1);
while($cnt--)
{
    $arr[] = array_shift($arr1);
    $arr[] = array_shift($arr2);
}

// print_r($arr);
// [a, x, b, y, c, z];

echo date('YW', time());
