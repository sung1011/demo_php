<?php
namespace App;

use Symfony\Component\Console\Application as console;
use Symfony\Component\Console\Command\Command as command;
use Pimple\Container;

class Application
{
    private static $container;

    public function run()
    {
        $this->init();
    }

    public function init()
    {
        $container = $this->getContainer();
        //config

        //server
        $container['server.ssh'] = function () {
            return new \App\server\Ssh;
        };

        //console
        $container['console'] = function () {
            return new console;
        };
        $container['taillog'] = function() {
            return new \App\console\Taillog;
        };

        $console = $container['console'];
        $console->add(new Demo);
        $console->add($container['taillog']);

        $console->run();
    }

    public function getContainer()
    {
        if(!self::$container) {
            self::$container = new Container;
        }
        return self::$container;
    }
}
