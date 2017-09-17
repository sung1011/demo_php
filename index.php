<?php

$str = '20170915';
$time = strtotime($str);
$t = date('Y-m-d H:i:s', $time);
echo $t;
