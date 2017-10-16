<?php
namespace App;

use Symfony\Component\Console\Application as console;
use Pimple\Container;

class Application
{
    public function run()
    {
        $this->init();
    }

    public function init()
    {
        //config

        $container = new Container;

        //console
        $container['console'] = function () {
            return new console;
        };

        $console = $container['console'];
        $console->add(new Demo);
        $console->add(new \App\console\Taillog);

        $console->run();
    }
}
