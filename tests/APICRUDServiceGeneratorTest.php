<?php

use Codenetix\StubGenerator\Generators\APIControllerGenerator;
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
use Codenetix\StubGenerator\Services\APICRUDGeneratorService;
use PHPUnit\Framework\TestCase;

class APICRUDServiceGeneratorTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testServiceRun(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new APICRUDGeneratorService($config, '/src/tests/FakeApp', 'Test', true);

        $generator->run();

        $this->assertInstanceOf(APICRUDGeneratorService::class, $generator);
    }
    
    protected function getConfigMockObject($rootNamespace){
        $config = Mockery::mock(Illuminate\Contracts\Config\Repository::class);
        $config->shouldReceive('get')
            ->with('stub_generator.stubsOverridePath', \Mockery::any())
            ->andReturn(null);

        $config->shouldReceive('get')->with('stub_generator.rootNamespace', \Mockery::any())
            ->andReturn($rootNamespace);

        return $config;
    }

}