<?php

namespace Acme\Console;

use Acme\Console\Commandinput;

class CommandInputParser
{
    public function parse($path, $properties)
    {
    	$segments = explode('\\', str_replace('/', '\\', $path));
    	$name = array_pop($segments);
    	$namespace = empty($segments) ? "App" : implode('\\', $segments);
    	
        $properties = $this->parseProperties($properties);

        return new Commandinput($name, $namespace, $properties);
    }

    private function parseProperties($properties)
    {
    	return preg_split('/ ?, ?/', $properties, null, PREG_SPLIT_NO_EMPTY);
    }
}
