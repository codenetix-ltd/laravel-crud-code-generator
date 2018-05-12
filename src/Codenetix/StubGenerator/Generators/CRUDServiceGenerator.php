<?php

namespace Codenetix\StubGenerator\Generators;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ControllerGenerator
 * @package Prettus\Repository\Generators
 */
class CRUDServiceGenerator extends BaseGenerator
{

    /**
     * CRUDServiceGenerator constructor.
     * @param Repository $config
     * @param $basePath
     * @param array $options
     */
    public function __construct(Repository $config, $basePath, array $options)
    {
        $options['stub'] = $options['stub'] ?: 'test/crud_api_feature';
        parent::__construct($config, $basePath, $options);
    }

    /**
     * @return string
     */
    public function getNamespace(){
        return 'namespace '.$this->getRootNamespace().'\\Services;';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/Services/' . $this->getServiceName() . 'Service.php';
    }

    /**
     * Gets service name based on model
     *
     * @return string
     */
    public function getServiceName()
    {
        return ucfirst($this->getSingularName());
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
            'service' => $this->getServiceName(),
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


}
