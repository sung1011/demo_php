<?php
class Parse
{
    public $json = 0;
    // public $xml = 0;
}
class ParseURI extends Parse
{
    function set($v)
    {
        $this->json = $v;
    }

    function test()
    {
        echo __CLASS__;
    }
}
// class ParseXML extends Parse
// {
//     function set($v)
//     {
//         $this->xml = $v;
//     }
// }
//----------------------------------------------------------
class Api
{
    function __construct(callable $closure)
    {
        $p = new ParseURI;
        $closure($p);
    }
}
// class xmlRPC
// {
//     function __construct(callable $closure)
//     {
//         $p = new ParseXML;
//         $closure($p);
//     }
// }

//----------------------------------------------------------
new Api(function(Parse $p){
    $p->set(123);
    echo $p->json;
    $p->test();
});
