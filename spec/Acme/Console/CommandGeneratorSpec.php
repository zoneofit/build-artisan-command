<?php

namespace spec\Acme\Console;

use Acme\Console\CommandGenerator;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Acme\Console\CommandInput;
use Illuminate\Filesystem\Filesystem;
use Mustache_Engine;

class CommandGeneratorSpec extends ObjectBehavior
{
	function let(Filesystem $file, Mustache_Engine $mustache)
	{
		$this->beConstructedWith($file, $mustache);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType(CommandGenerator::class);
    }

    function it_generates_a_file(Filesystem $file, Mustache_Engine $mustache)
    {
    	$input = new CommandInput('SomeCommand', 'Acme\Bar', ['uername', 'email']);
    	$template = 'foo.stub';
    	$destination = 'app/Acme/Bar/SomeCommand.php';

    	$file->get($template)->shouldBecalled()->willReturn('template');
    	$mustache->render('template', $input)->shouldBecalled()->willReturn('stub');

    	$file->put($destination, 'stub')->shouldBecalled();

    	$this->make($input, $template, $destination);
    }
}
