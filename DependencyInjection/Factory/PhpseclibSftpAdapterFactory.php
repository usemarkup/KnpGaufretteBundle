<?php

namespace Knp\Bundle\GaufretteBundle\DependencyInjection\Factory;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

/**
 * PhpseclibSftp Adapter Factory
 */
class PhpseclibSftpAdapterFactory implements AdapterFactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function create(ContainerBuilder $container, $id, array $config)
    {
        $childDefinition = class_exists('\Symfony\Component\DependencyInjection\ChildDefinition')
            ? new ChildDefinition('knp_gaufrette.adapter.phpseclibsftp')
            : new DefinitionDecorator('knp_gaufrette.adapter.phpseclibsftp');

        $container
            ->setDefinition($id, $childDefinition)
            ->addArgument($config['host'])
            ->addArgument($config['directory'])
            ->addArgument($config['create'])
            ->addArgument($config['username'])
            ->addArgument($config['password']);
    }

    /**
     * {@inheritDoc}
     */
    public function getKey()
    {
        return 'phpseclibsftp';
    }

    /**
     * {@inheritDoc}
     */
    public function addConfiguration(NodeDefinition $builder)
    {
        $builder
            ->children()
                ->scalarNode('host')->isRequired()->end()
                ->scalarNode('directory')->defaultNull()->end()
                ->scalarNode('username')->defaultFalse()->end()
                ->scalarNode('password')->defaultFalse()->end()
                ->booleanNode('create')->defaultFalse()->end()
            ->end()
        ;
    }
}
