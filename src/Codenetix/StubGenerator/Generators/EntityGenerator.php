<?php

namespace Codenetix\StubGenerator\Generators;

use Illuminate\Contracts\Config\Repository;

class EntityGenerator extends BaseGenerator
{
    /**
     * RequestGenerator constructor.
     * @param Repository $config
     * @param $basePath
     * @param array $options
     */
    public function __construct(Repository $config, $basePath, array $options)
    {
        $options['stub'] = $options['stub'] ?: 'entity/model';
        parent::__construct($config, $basePath, $options);
    }

    /**
     * @return string
     */
    public function getNamespace(){
        return 'namespace '.$this->getRootNamespace().'\\Entities;';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/Entities/' . $this->getClass() . '.php';
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
}
