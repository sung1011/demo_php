<?php 
namespace App;

use Symfony\Component\Console\Application as console;
use Pimple\Container;

class Application
{
    function run()
    {
        $this->init();
    }
    
    function init()
    {
        $container = new Container;

        //init config
        \App\config\Init::register();

        //init ssh 
        $r = $container->keys();
        print_r($r);
        $sshConf = $container['config.ssh'];
        print_r($sshConf);

        //init console
        $container['console'] = function() {
            return new console;
        };
        $console = $container['console'];
        $console->add(new \App\Demo);
        $console->add(new \App\console\Taillog);
        
        $console->run();
    }


}