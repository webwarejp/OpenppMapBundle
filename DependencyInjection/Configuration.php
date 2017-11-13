<?php

namespace Openpp\MapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('openpp_map');

        $supportedManagerTypes = ['orm'];

        $rootNode
            ->children()
                ->scalarNode('db_driver')
                    ->defaultValue('orm')
                    ->validate()
                        ->ifNotInArray($supportedManagerTypes)
                        ->thenInvalid('The db_driver %s is not supported. Please choose one of '.json_encode($supportedManagerTypes))
                    ->end()
                ->end()
                ->arrayNode('class')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('circle')->defaultValue('Application\\Openpp\\MapBundle\\Entity\\Circle')->end()
                        ->scalarNode('point')->defaultValue('Application\\Openpp\\MapBundle\\Entity\\Point')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
