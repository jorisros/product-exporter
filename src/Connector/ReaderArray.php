<?php

namespace JorisRos\LibraryProductExporter\Connector;

use Symfony\Component\Config\Definition\Processor;

class ReaderArray implements ReaderInterface
{
    private Processor $processor;
    private array $data;
    public function __construct(private Configuration $config) {
        $this->processor = new Processor();
    }

    public function readFromArray(array $array): void
    {
        $this->data = $array;
    }
    public function getArray(): array
    {
        return $this->processor->processConfiguration($this->config, [$this->data]);
    }
}