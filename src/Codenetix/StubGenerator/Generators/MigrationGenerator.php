<?php

namespace Codenetix\StubGenerator\Generators;

use Illuminate\Contracts\Config\Repository;

class MigrationGenerator extends BaseGenerator
{

    /**
     * ResourceGenerator constructor.
     * @param Repository $config
     * @param $basePath
     * @param array $options
     */
    public function __construct(Repository $config, $basePath, array $options)
    {
        $options['stub'] = $options['stub'] ?: 'migration/migration';
        parent::__construct($config, $basePath, $options);
    }

    /**
     * @return string
     */
    public function getNamespace(){
        return '';
    }

    /**
     * Get destination path for generated file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->getBasePath() . '/migrations/'.date('Y_m_d_His').'_create_' . $this->getPluralName() . '_table.php';
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
            'migration'  => $this->getMigration()
        ]);
    }

    public function getMigration(){
        return ucfirst($this->getPluralName());
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
