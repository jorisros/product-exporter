<?php

namespace Processor;

use JorisRos\LibraryProductExporter\Connector;
use JorisRos\LibraryProductExporter\Connector\Configuration;
use JorisRos\LibraryProductExporter\Connector\ReaderArray;
use JorisRos\LibraryProductExporter\Processor\DefaultProcessor;
use JorisRos\LibraryProductExporter\Transform\Capital;
use PHPUnit\Framework\TestCase;

class DefaultProcessorTest extends TestCase
{
    public function testProcess()
    {
        $configuration = new Configuration();

        $reader = new ReaderArray($configuration);
        $reader->readFromArray($this->readConfigurationFromArrayMultiDept());

        $connector = new Connector($reader,
            new DefaultProcessor(
                $reader->getArray(),
                [
                    new Capital(),
                ]
            ));

        $data = $connector->process($this->getProductData());
        $this->assertIsArray($data);
        $this->assertIsFloat($data['product']['price']);
        $this->assertIsString($data['product']['title']);
        $capital = substr($data['product']['title'], 0, 1);
        $this->assertEquals('T', $capital);
    }
    public function testProcessSingleDept()
    {
        $configuration = new Configuration();

        $reader = new ReaderArray($configuration);
        $reader->readFromArray($this->readConfigurationFromArraySingleDept());

        $connector = new Connector($reader,
            new DefaultProcessor(
                $reader->getArray(),
                [
                    new Capital(),
                ]
            ));

        $data = $connector->process($this->getProductData());
        $this->assertIsArray($data);
        $this->assertIsFloat($data['price']);
        $this->assertIsString($data['title']);
        $capital = substr($data['title'], 0, 1);
        $this->assertEquals('T', $capital);
    }


    private function getProductData(): array
    {
        return [
            'productTitle' => 't-shirt',
            'sku' => '00001',
            'price' => 9.95,
            'valuta' => 'EUR',
            'category' => 'clothing',
            'attributes' => [
                [
                    'size' => 'small',
                ],
                [
                    'color' => 'white'
                ]
            ]
        ];
    }

    private function readConfigurationFromArraySingleDept(): array
    {
        return $this->readConfigurationFromArray([
            [
                'destinationField' => 'title',
                'sourceField' => 'productTitle',
                'transformer' => 'JorisRos\\LibraryProductExporter\\Transform\\Capital'
            ],
            [
                'destinationField' => 'price',
                'sourceField' => 'price',
                'transformer' => null
            ]

        ]);
    }
    private function readConfigurationFromArrayMultiDept(): array
    {
        return $this->readConfigurationFromArray([
            [
                'destinationField' => 'product.title',
                'sourceField' => 'productTitle',
                'transformer' => 'JorisRos\\LibraryProductExporter\\Transform\\Capital'
            ],
            [
                'destinationField' => 'product.price',
                'sourceField' => 'price',
                'transformer' => null
            ]

        ]);
    }

    private function readConfigurationFromArray(array $mapping): array
    {
        return [
            'name' => 'Shopify connector',
            'icon' => '/icon.gif',
            'arguments' => [
                'shopClass' => '\\Bla',
                'shopId' => 100
            ],
            'mapping' => $mapping,
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