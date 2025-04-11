<?php

namespace Connector;

use JorisRos\LibraryProductExporter\Connector\Configuration;
use JorisRos\LibraryProductExporter\Connector\ReaderArray;
use JorisRos\LibraryProductExporter\Connector\ReaderInterface;
use PHPUnit\Framework\TestCase;

class ReaderArrayTest extends TestCase
{
    public function testConfiguration()
    {
        $configuration = new Configuration();

        $reader = new ReaderArray($configuration);
        $this->assertInstanceOf(ReaderInterface::class, $reader);

        $reader->readFromArray($this->readFromArray());
        $this->assertIsArray($reader->getArray());
    }

    private function readFromArray(): array
    {
        return [
            'name' => 'Shopify connector',
            'icon' => '/icon.gif',
            'arguments' => [
                'shopClass' => '\\Bla',
                'shopId' => 100
            ],
            'mapping' => [
                [
                    'destinationField' => 'product.title',
                    'sourceField' => 'productTitle',
                    'transformer' => 'JorisRos\\LibraryProductExporter\\Transform\\Capital'
                ]
            ],
            'transport' => [
                'class' => '\\JorisRos\\LibraryProductExporter\\Transport\\TransportGuzzle',
                'options' => [
                    'access-token' => '',
                    'url' => ''
                ]
            ]
        ];
    }
}
