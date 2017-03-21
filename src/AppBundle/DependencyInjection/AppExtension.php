<?php

namespace AppBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class AppExtension extends Extension
{
    /**
     * @var ContainerBuilder
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->container = $container;

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $loader->load('managers.xml');
        $loader->load('mailers.xml');
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'app';
    }
}
