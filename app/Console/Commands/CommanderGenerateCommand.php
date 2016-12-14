<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Acme\Console\CommandInputParser;
use Acme\Console\CommandGenerator;

class CommanderGenerateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'commander:generate {path : Path to the class to generate.} {--properties=} {--base=./app : Default App path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate command.';

    protected $parser;

    protected $generator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CommandInputParser $parser, CommandGenerator $generator)
    {
        parent::__construct();

        $this->parser = $parser;
        $this->generator = $generator;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Parse the input for the Artisan command into a usable format.
        $input = $this->parser->parse(
            $this->argument('path'),
            $this->option('properties')
        );

        // Actually create a file with the correct boilerplate.
        $this->generator->make(
            $input,
            app_path('Console/Commands/templates/command.template'),
            $this->getClassPath()
        );

        $this->info('All done!');
    }

    private function getClassPath()
    {
        return $this->option('base') . '/' . $this->argument('path') . '.php';
    }
}
