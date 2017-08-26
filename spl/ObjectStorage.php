<?php
// The SplObjectStorage class provides a map from objects to data or,
// by ignoring data, an object set. This dual purpose can be useful in many cases
// involving the need to uniquely identify objects.
$s = new SplObjectStorage;
$o1 = new stdClass;
$o2 = new stdClass;
$o3 = new stdClass;

$s->attach($o1);
$s->attach($o2, 2222);

$s->rewind();
while($s->valid()){
    $key = $s->key();
    $obj = $s->current();
    $data = $s->getInfo();

    print_r($key);
    print_r($obj);
    print_r($data);
    echo PHP_EOL;

    $s->next();
}
