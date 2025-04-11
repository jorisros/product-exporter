<?php

namespace JorisRos\LibraryProductExporter\Processor;

use JorisRos\LibraryProductExporter\Connector\Configuration;
use JorisRos\LibraryProductExporter\Transform\TransformInterface;

class DefaultProcessor implements ProcessorInterface
{
    private array $result = [];
    public function __construct(readonly private array $configuration, readonly private array $transformers)
    {

    }

    #[\Override]
    public function process(array $fields): array
    {
        $transformers = $this->getTransforms();
        //var_dump($this->configuration);
        $this->addValueToResult('field', strin);
        return $fields;
    }

    private function addValueToResult(TransformInterface $transform, string $field): void
    {

    }
    private function getMapping()
    {

    }

    private function getTransforms(): array
    {
        $acceptedTransformers = [];

        foreach ($this->transformers as $transformer) {
            if ($transformer instanceof TransformInterface) {
                $acceptedTransformers[] = $transformer;
            }
        }

        return $acceptedTransformers;
    }
}