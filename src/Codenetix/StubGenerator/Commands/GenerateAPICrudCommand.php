<?php

namespace Codenetix\StubGenerator\Commands;

use Codenetix\StubGenerator\Services\APICRUDGeneratorService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateAPICrudCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:api_crud';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'CRUD class stubs generator.';

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        $name =  $this->argument('name');
        $force = $this->option('force');

        $generator = new APICRUDGeneratorService(config('stub_generator'), base_path(), $name, $force);
        $generator->run();
    }


    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of model for which the CRUD is being generated.',
                null
            ],
        ];
    }


    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
        ];
    }
}
