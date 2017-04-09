<?php

namespace App\Component\Filter;

class Ch implements Abs
{
	function __construct()
	{
		echo 'service:' . __CLASS__ ;
		echo '<br>';
	}

	function run(string $content) : string
	{
		return $content;
	}
}
