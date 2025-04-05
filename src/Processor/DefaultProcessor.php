<?php

namespace JorisRos\LibraryProductExporter\Processor;

use JorisRos\LibraryProductExporter\Connector\Configuration;

class DefaultProcessor implements ProcessorInterface
{
    public function __construct(private array $configuration)
    {

    }

    public function process(array $fields): array
    {
        $this->getTransforms();
        var_dump($this->configuration);
        return $fields;
    }

    private function getMapping()
    {

    }

    private function getTransforms(): array
    {
        var_dump(get_declared_classes());
        die('stop');
        $transformers = array_filter(
            get_declared_classes(),
            function ($className) {
                return in_array('TransformInterface', class_implements($className));
            }
        );
        var_dump($transformers);
        return [

        ];
    }
}