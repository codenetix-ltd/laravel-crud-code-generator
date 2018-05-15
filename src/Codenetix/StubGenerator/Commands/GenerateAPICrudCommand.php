<?php

namespace Codenetix\StubGenerator\Commands;

use Codenetix\StubGenerator\Services\APICRUDGeneratorService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Composer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateAPICrudCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:crud';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'CRUD class stubs generator.';

    /**
     * @var Composer
     */
    private $composer;

    /**
     * @var Repository
     */
    private $config;

    /**
     * GenerateAPICrudCommand constructor.
     * @param Repository $config
     * @param Composer $composer
     */
    public function __construct(Repository $config, Composer $composer)
    {
        parent::__construct();
        $this->composer = $composer;
        $this->config = $config;
    }

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
        $renameOld = $this->option('rename-old');

        $generator = new APICRUDGeneratorService($this->config, base_path(), $name, $force, $renameOld);
        $generator->run();

        $this->composer->dumpAutoloads();
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
                'rename-old',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
        ];
    }
}
