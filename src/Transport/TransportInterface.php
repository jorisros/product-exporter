<?php

namespace JorisRos\LibraryProductExporter\Transport;

interface TransportInterface
{
    public function __construct(array $configuration);
    public function validate(array $data): array;
    public function transfer(array $data): void;
}
