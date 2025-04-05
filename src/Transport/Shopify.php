<?php

namespace JorisRos\LibraryProductExporter\Transport;

use JorisRos\LibraryProductExporter\Transport\TransportInterface;

class Shopify implements TransportInterface
{

    public function __construct(private array $configuration)
    {
    }

    public function transfer(array $data): void
    {
        // TODO: Implement transfer() method.
    }
}