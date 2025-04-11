<?php

namespace JorisRos\LibraryProductExporter\Transform;

interface TransformInterface
{
    public function transform($value): void;
    public function getValue(): array|string|int|float|bool;
}
