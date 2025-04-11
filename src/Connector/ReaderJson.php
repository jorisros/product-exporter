<?php

namespace JorisRos\LibraryProductExporter\Connector;

use Symfony\Component\Config\Definition\Processor;

class ReaderJson implements ReaderInterface
{
    private Processor $processor;
    private array $data;

    public function __construct(private Configuration $config)
    {
        $this->processor = new Processor();
    }

    public function readFromFile(string $location)
    {
        if (!file_exists($location)) {
            throw new \Exception("File does not exist");
        }

        $this->data = json_decode(file_get_contents($location), true, flags: JSON_THROW_ON_ERROR);
    }

    public function read(string $jsonContent)
    {
        $this->data = json_decode($jsonContent, true);
    }

    #[\Override]
    public function getArray(): array
    {
        return $this->processor->processConfiguration($this->config, [$this->data]);
    }
}
