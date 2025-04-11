<?php

namespace JorisRos\LibraryProductExporter\Processor;

use JorisRos\LibraryProductExporter\Connector\Configuration;
use JorisRos\LibraryProductExporter\Transform\DefaultTransform;
use JorisRos\LibraryProductExporter\Transform\TransformInterface;

class DefaultProcessor implements ProcessorInterface
{
    private array $result = [];
    public function __construct(
        readonly private array $configuration,
        readonly private array $transformers
    ) {}

    #[\Override]
    public function process(array $fields): array
    {
        $transformers = $this->getTransforms();
        foreach ($this->configuration['mapping'] as $arrMapping) {
            $transform = new DefaultTransform();

            if (!empty($arrMapping['transformer'])) {
                if (key_exists($arrMapping['transformer'], $transformers)) {
                    $transform = $transformers[$arrMapping['transformer']];
                }
            }

            $transform->transform($fields[$arrMapping['sourceField']]);
            $this->addValueToResult($transform, $arrMapping['destinationField']);
        }

        return $this->result;
    }

    private function addValueToResult(TransformInterface $transform, string $field): void
    {
        $array = $this->stringToMultiArrayWithValue($field, $transform->getValue());
        $this->result = array_merge_recursive($this->result, $array);
    }

    private function getTransforms(): array
    {
        $acceptedTransformers = [];

        foreach ($this->transformers as $transformer) {
            if ($transformer instanceof TransformInterface) {
                $acceptedTransformers[get_class($transformer)] = $transformer;
            }
        }

        return $acceptedTransformers;
    }

    private function stringToMultiArrayWithValue($string, $value): array
    {
        $levels = explode('.', $string);
        $result = [];
        $current = &$result;

        foreach ($levels as $level) {
            $current[$level] = [];
            $current = &$current[$level];
        }

        // Add the value to the deepest level
        $current = $value;

        return $result;
    }
}
