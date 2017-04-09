<?php

namespace App\Service;

class Factory
{
	private static $_instance = null;

	static function getService($name, $di = [])
	{
		if(empty(self::$_instance[$name])) {
			$class = __NAMESPACE__ . '\\' . ucfirst($name);
			self::$_instance[$name] = new $class($di);
		}
		return self::$_instance[$name];
	}
}
