<?php

namespace JorisRos\LibraryProductExporter\Transform;

use JetBrains\PhpStorm\ObjectShape;

class Capital implements TransformInterface
{
    private string $value;
    #[\Override]
    public function transform($value): void
    {
        $this->value = ucfirst((string) $value);
    }
    public function getValue(): array|string|int|float|bool
    {
        return $this->value;
    }
}
