<?php

namespace App\Service;

class Email implements AbsMail
{
	private $_di = [];

	function __construct($di)
	{
		$this->_di = $di;
	}

	function send()
	{
		// $input = $this->_di->get('req');
		// $data = $input->handler();
		$data = 'aaaa';

		$filter = $this->_di->get('filter');
		$content = $filter->run($data);

		$db = $this->_di->get('db');
		$db->commit($content);
	}

	function receive()
	{

	}
}
