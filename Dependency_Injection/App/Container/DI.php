<?php

namespace App\Container;

class DI implements Abs
{
	protected $call;

	public function set(string $name, $val)
	{
		$this->call[$name] = $val;
	}

	public function get($name)
	{
		if(!isset($this->call[$name])) {
			return ;
		}

		$call = $this->call[$name];

		if(isset($call['param'])){
			$class = new \ReflectionClass($call['class']);
			$instance = $class->newInstanceArgs($call['param']);
		}else{
			$instance = new $call['class'];
		}
		return $instance;
	}
}
