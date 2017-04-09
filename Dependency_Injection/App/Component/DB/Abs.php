<?php

namespace App\DB;

interface Abs
{
	public function __construct($host, $port, $uname, $pwd);

	public function commit();
}
