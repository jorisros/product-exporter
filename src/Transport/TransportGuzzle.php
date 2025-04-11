<?php

namespace JorisRos\LibraryProductExporter\Transport;

class TransportGuzzle implements TransportInterface
{
    public function __construct(private array $configuration)
    {
    }

    #[\Override]
    public function transfer(array $data): void
    {
        var_dump($data);
    }
}
