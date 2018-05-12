<?php

namespace Codenetix\StubGenerator\Generators;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ControllerGenerator
 * @package Prettus\Repository\Generators
 */
class CRUDAPIFeatureTestGenerator extends BaseGenerator
{
    /**
     * @var array
     */
    private $testsPath;

    /**
     * APIControllerGenerator constructor.
     * @param Repository $config
     * @param $basePath
     * @param array $testsPath
     * @param array $options
     */
    public function __construct(Repository $config, $basePath, $testsPath, array $options)
    {
        $options['stub'] = $options['stub'] ?: 'test/crud_api_feature';
        $this->testsPath = $testsPath;
        parent::__construct($config, $basePath, $options);
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getTestsPath() . '/Feature/' . $this->getName() . 'Test.php';
    }

    /**
     * @return string
     */
    public function getNamespace(){
        return 'namespace Tests\\Feature;';
    }

    /**
     * Gets plural name based on model
     *
     * @return string
     */
    public function getPluralName()
    {

        return str_plural(lcfirst(ucwords($this->getClass())));
    }

    /**
     * Get array replacements.
     *
     * @return array
     */
    public function getReplacements()
    {
        return array_merge(parent::getReplacements(), [
            'plural'     => $this->getPluralName(),
            'singular'   => $this->getSingularName(),
            'appname'    => $this->getRootNamespace(),
        ]);
    }

    /**
     * Gets singular name based on model
     *
     * @return string
     */
    public function getSingularName()
    {
        return str_singular(lcfirst(ucwords($this->getClass())));
    }

    /**
     * @return array
     */
    public function getTestsPath()
    {
        return $this->testsPath;
    }

    /**
     * @param array $testsPath
     */
    public function setTestsPath($testsPath)
    {
        $this->testsPath = $testsPath;
    }
}
