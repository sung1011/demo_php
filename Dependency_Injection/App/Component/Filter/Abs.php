<?php

namespace App\Component\Filter;

interface Abs
{
	public function run(string $content) : string;
}
