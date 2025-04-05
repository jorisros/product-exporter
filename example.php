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
    'productTitle' => 'Hello product'
]);

$connector->transport($data);
