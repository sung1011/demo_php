<?php

class Obj implements ArrayAccess, IteratorAggregate
{
    public function __construct($name, $age, $job)
    {
        $this->container = [
            'name' => $name,
            'age' => $age,
            'job' => $job,
        ];
    }

    function offsetExists($key)//isset($arr[$key])
    {
        return isset($this->container[$key]);
    }

    function offsetGet($key)//$arr[$key]
    {
        return $this->container[$key];
    }

    function offsetSet($key, $val)//$arr[$key] = $val
    {
        return $this->container[$key] = $val;
    }

    function offsetUnset($key)//unset($arr[$key])
    {
        unset($this->container[$key]);
    }

    function getIterator()
    {
        return new ArrayIterator($this->container);
    }
}

$arr = new Obj('sun', 18, 'php');
print_r($arr['name']);
echo PHP_EOL;
echo isset($arr['age']);
echo PHP_EOL;
unset($arr['job']);
echo isset($arr['job']);
echo PHP_EOL;
$arr['job'] = 'python';
echo $arr['job'];
echo PHP_EOL;

foreach($arr as $k=>$v) {
    echo $k;
    echo ':';
    print_r($v);
    echo PHP_EOL;
}
