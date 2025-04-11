# Generic product exporter
## Requements
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
    new JorisRos\LibraryProductExporter\Processor\DefaultProcessor(
        $reader->getArray(),
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

$connector->transport($data);
```
Run that file
```bash
php example.php
```

## Tests
```bash
composer install
```
```bash
php vendor/bin/phpunit tests
```
