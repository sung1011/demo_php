<?php

$closure = function()
{
    $a = 1;
    // echo 123;
    return 321;
};

$c = $closure();
echo $c;
