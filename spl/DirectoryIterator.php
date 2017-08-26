<?php

$dir = new DirectoryIterator(__DIR__);
foreach($dir as $item){
    echo $item;
    if($item->isFile()){
        echo ' ';
        echo $item->getExtension();
    }
        echo PHP_EOL;
}
