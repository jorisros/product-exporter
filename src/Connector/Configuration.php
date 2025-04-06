<?php

namespace JorisRos\LibraryProductExporter\Connector;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    #[\Override]
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('');

        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('name')->isRequired()->end()
                ->scalarNode('icon')->isRequired()->end()
                ->arrayNode('arguments')
                    ->children()
                        ->scalarNode('shopClass')->isRequired()->end()
                        ->integerNode('shopId')->isRequired()->end()
                    ->end()
                ->end()
                ->arrayNode('mapping')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('destinationField')->isRequired()->end()
                            ->scalarNode('sourceField')->isRequired()->end()
                            ->scalarNode('transformer')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('transport')
                    ->children()
                        ->scalarNode('class')->isRequired()->end()
                        ->variableNode('options')
                            ->defaultValue([])
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }

}

