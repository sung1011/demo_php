<?php

namespace App\Component\DB;

class Mysql
{
	function __construct($host, $port, $uname, $pwd)
	{
		echo 'service:' . __CLASS__ ;
		echo '<br>';
	}

	function commit($data)
	{

	}
}
