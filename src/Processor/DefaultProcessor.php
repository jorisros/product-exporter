<?php

namespace JorisRos\LibraryProductExporter\Processor;

use JorisRos\LibraryProductExporter\Connector\Configuration;

class DefaultProcessor implements ProcessorInterface
{
    public function __construct(private array $configuration)
    {

    }

    #[\Override]
    public function process(array $fields): array
    {
        $this->getTransforms();
        //var_dump($this->configuration);
        return $fields;
    }

    private function getMapping()
    {

    }

    private function getTransforms(): array
    {
        return [

        ];
    }
}