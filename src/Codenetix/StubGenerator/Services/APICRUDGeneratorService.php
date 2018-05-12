<?php

namespace Codenetix\StubGenerator\Services;

use Codenetix\StubGenerator\Generators\APIControllerGenerator;
use Codenetix\StubGenerator\Generators\BaseGenerator;
use Codenetix\StubGenerator\Generators\CollectionResourceGenerator;
use Codenetix\StubGenerator\Generators\CRUDAPIFeatureTestGenerator;
use Codenetix\StubGenerator\Generators\CRUDServiceGenerator;
use Codenetix\StubGenerator\Generators\EntityGenerator;
use Codenetix\StubGenerator\Generators\MigrationGenerator;
use Codenetix\StubGenerator\Generators\ModelFactoryGenerator;
use Codenetix\StubGenerator\Generators\RepositoryClassGenerator;
use Codenetix\StubGenerator\Generators\RepositoryInterfaceGenerator;
use Codenetix\StubGenerator\Generators\RequestGenerator;
use Codenetix\StubGenerator\Generators\ResourceGenerator;
use Illuminate\Contracts\Config\Repository;

/**
 * Class APICRUDGenerator
 * @package Prettus\Repository\Generators
 */
class APICRUDGeneratorService
{

    /**
     * @var string
     */
    private $basePath;

    /**
     * @var Repository
     */
    private $config;
    private $entityName;
    private $force;

    /**
     * APICRUDGeneratorService constructor.
     * @param Repository $config
     * @param $basePath
     * @param $entityName
     * @param $force
     */
    public function __construct(Repository $config, $basePath, $entityName, $force)
    {
        $this->basePath = $basePath;
        $this->config = $config;
        $this->entityName = $entityName;
        $this->force = $force;
    }

    protected function getOptions(){
        return [
            'name' => $this->entityName,
            'force' => $this->force,
            'stub' => null
        ];
    }

    protected function defineGenerators(){
        return [
            new APIControllerGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new CollectionResourceGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new CRUDAPIFeatureTestGenerator($this->config, $this->basePath.'/app', $this->basePath.'/tests', $this->getOptions()),
            new CRUDServiceGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new EntityGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new MigrationGenerator($this->config, $this->basePath.'/database', $this->getOptions()),
            new ModelFactoryGenerator($this->config, $this->basePath.'/database', $this->getOptions()),
            new RepositoryClassGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new RepositoryInterfaceGenerator($this->config, $this->basePath.'/app', $this->getOptions()),
            new RequestGenerator($this->config, $this->basePath.'/app', array_merge($this->getOptions(), ['name' => $this->entityName.'Create'])),
            new RequestGenerator($this->config, $this->basePath.'/app', array_merge($this->getOptions(), ['name' => $this->entityName.'Update'])),
            new ResourceGenerator($this->config, $this->basePath.'/app', $this->getOptions())
        ];
    }

    public function run(){
        /**
         * @var BaseGenerator $generator
         */
        foreach ($this->defineGenerators() as $generator){
            $generator->run();
        }
    }
}
