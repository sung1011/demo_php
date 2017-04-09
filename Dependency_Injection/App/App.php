<?php

class App
{
	private static $_instance = null;

	public static function &getInstance()
	{
		if(is_null(self::$_instance)) {
			self::$_instance = new static();
		}
		return self::$_instance;
	}

	function __clone(){

	}

	function run()
	{
		$di = new \App\Container\DI;

		//req DI
		// $di->set('req', $req);

		//filter DI
		$di->set('filter', [
			'class' => '\App\Component\Filter\En',
		]);

		//db DI
		$di->set('db', [
			'class' => '\App\Component\DB\Mysql',
			'param' => [
				'host'=>'127.0.0.1',
				'port'=>'3306',
				'uname'=>'root',
				'pwd'=>'123456',
			],
		]);

		$email = \App\Service\Factory::getService('Email', $di);
		$email->send();
	}
}
