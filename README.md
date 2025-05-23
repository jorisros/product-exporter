# Generic product exporter
## Requirements
* Minumal PHP version 8.2 

## Usage
Add the library to your project
```bash
composer require jorisros/product-exporter
```
Create a file ``example.php``
```php
<?php

use Symfony\Component\Config\Definition\Processor;

require_once "vendor/autoload.php";

$configuration = new \JorisRos\LibraryProductExporter\Connector\Configuration();
$reader = new \JorisRos\LibraryProductExporter\Connector\ReaderJson($configuration);
$reader->read(file_get_contents("file.json"));

$connector = new \JorisRos\LibraryProductExporter\Connector(
    $reader,
    new JorisRos\LibraryProductExporter\Processor\DefaultProcessor([
            'name' => 'Generic product connector',
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
        ],
        [
            new \JorisRos\LibraryProductExporter\Transform\Capital(),
        ]
    )
);

$data = $connector->process([
    'productTitle' => 'Hello product',
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
]);
```
Run that file
```bash
php example.php
```
Where ``$data`` will be transformed as below
```php
array(1) {
  ["product"]=>
  array(1) {
    ["title"]=>
    string(13) "Hello product"
  }
}
```

## Transformers
The library has the following transformer 
### Money to float
To convert the prices to a float for example ``€ 12,30`` to ``12.30``.<br>
Add the class ``JorisRos\LibraryProductExporter\Transform\MoneyToFloat`` to the mapper.
### Capital
To convert the string to for example ``t-shirt`` to ``T-shirt``.<br>
Add the class ``JorisRos\LibraryProductExporter\Transform\Capital`` to the mapper.


## Tests
```bash
composer install
```
```bash
php vendor/bin/phpunit tests
```
