<?php

namespace JorisRos\LibraryProductExporter\Transform;

class Capital implements TransformInterface
{
    public function transform($value)
    {
        return ucfirst($value);
    }
}