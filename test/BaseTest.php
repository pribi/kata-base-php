<?php

namespace Kata\Test;

use Kata\Base;

class BaseTest extends \PHPUnit_Framework_TestCase
{
	public function testBase()
	{
		$base = new Base();

		$this->assertEquals(0.1, $base->getVersion(0));
        $this->assertEquals(0.1, $base->getVersion(1));
	}
}
