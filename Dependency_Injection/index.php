<?php

spl_autoload_register(function($class) {
	include(__DIR__ . '/' . $class . '.php');
});

require 'App/App.php';
App::getInstance()->run();
