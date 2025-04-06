<?php

namespace JorisRos\LibraryProductExporter\Transform;

use JetBrains\PhpStorm\ObjectShape;

class Capital implements TransformInterface
{
    #[\Override]
    public function transform($value)
    {
        return ucfirst($value);
    }
}