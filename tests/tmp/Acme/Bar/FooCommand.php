<?php

namespace Acme\Bar;

class FooCommand
{
	public $bar;
	public $baz;

	function __construct($bar, $baz)
	{
		$this->bar = $bar;
		$this->baz = $baz;
	}
}