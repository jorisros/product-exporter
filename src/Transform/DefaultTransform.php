<?php

namespace JorisRos\LibraryProductExporter\Transform;

class DefaultTransform implements TransformInterface
{
    private array|string|int|float|bool $value;

    #[\Override]
    public function transform($value): void
    {
        switch ($value) {
            case is_bool($value):
            case is_array($value):
            case is_string($value):
            case is_int($value):
            case is_float($value):
                $this->value = $value;
                break;
            default:
                $this->value = (string) $value;
        }
    }

    #[\Override]
    public function getValue(): array|string|bool|int|float
    {
        return $this->value;
    }
}
