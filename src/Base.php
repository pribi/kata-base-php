<?php

namespace Kata;

class Base
{
	const VERSION = 0.1;

	public function getVersion($param)
	{
        if ($param == 0)
        {
            return self::VERSION;
        }
        else
        {
            return self::VERSION;
        }
	}
}
