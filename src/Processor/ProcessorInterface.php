<?php

namespace JorisRos\LibraryProductExporter\Processor;
use JorisRos\LibraryProductExporter\Connector\Configuration;

interface ProcessorInterface
{
    public function __construct(array $configuration, array $transformers);
    public function process(array $fields): array;
}