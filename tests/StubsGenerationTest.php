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
use PHPUnit\Framework\TestCase;

class StubsGenerationTest extends TestCase
{
    public function tearDown()
    {
        Mockery::close();
    }

    public function testAPIControllerGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new APIControllerGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(APIControllerGenerator::class, $generator);
    }

    public function testCRUDServiceGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new CRUDServiceGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(CRUDServiceGenerator::class, $generator);
    }

    public function testCollectionResourceGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new CollectionResourceGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(CollectionResourceGenerator::class, $generator);
    }

    public function testResourceGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new ResourceGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(ResourceGenerator::class, $generator);
    }

    public function testRequestCreateGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new RequestGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'TestCreate',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(RequestGenerator::class, $generator);
    }

    public function testRequestUpdateGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new RequestGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'TestUpdate',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(RequestGenerator::class, $generator);
    }

    public function testEntityGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new EntityGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(EntityGenerator::class, $generator);
    }

    public function testRepositoryClassGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new RepositoryClassGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(RepositoryClassGenerator::class, $generator);
    }

    public function testRepositoryInterfaceGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new RepositoryInterfaceGenerator($config, '/src/tests/FakeApp/src', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(RepositoryInterfaceGenerator::class, $generator);
    }

    public function testTestGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new CRUDAPIFeatureTestGenerator($config, '/src/tests/FakeApp/src', '/src/tests/FakeApp/tests', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(CRUDAPIFeatureTestGenerator::class, $generator);
    }

    public function testModelFactoryGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new ModelFactoryGenerator($config, '/src/tests/FakeApp/database', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(ModelFactoryGenerator::class, $generator);
    }

    public function testMigrationGenerator(): void
    {
        $config = $this->getConfigMockObject('App');

        $generator = new MigrationGenerator($config, '/src/tests/FakeApp/database', [
            'name' => 'Test',
            'force' => true
        ]);

        $generator->run();

        $this->assertInstanceOf(MigrationGenerator::class, $generator);
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