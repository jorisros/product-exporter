<?php

namespace JorisRos\LibraryProductExporter;

use JorisRos\LibraryProductExporter\Connector\Configuration;
use JorisRos\LibraryProductExporter\Connector\ReaderInterface;
use JorisRos\LibraryProductExporter\Connector\ReaderJson;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;

class ConfigurationTest extends TestCase
{

    public function testConfiguration()
    {
        $configuration = new Configuration();
        $reader = new ReaderJson($configuration);

        $this->assertInstanceOf(ReaderJson::class, $reader);
        $this->assertInstanceOf(ReaderInterface::class, $reader);

        $reader->readFromFile(__DIR__ . "/../Resources/testConfiguration.json");
        $this->assertIsArray($reader->getArray());

        $reader = new ReaderJson($configuration);
        $reader->read(file_get_contents(__DIR__ . "/../Resources/testConfiguration.json"));
        $this->assertIsArray($reader->getArray());
    }

    public function testConfigurationTestExceptionFileNotFound()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("File does not exist");

        $configuration = new Configuration();
        $reader = new ReaderJson($configuration);
        $reader->readFromFile(__DIR__ . "/../Resources/testConfiguration_not.json");
    }

    public function testConfigurationBrokenJson()
    {
        $this->expectException(\JsonException::class);
        $this->expectExceptionMessage("Syntax error");

        $configuration = new Configuration();
        $reader = new ReaderJson($configuration);
        $reader->readFromFile(__DIR__ . "/../Resources/testBrokenJson.json");
    }

    public function testConfigrationReading()
    {
        $configuration = new Configuration();
        $reader = new ReaderJson($configuration);

        $defaultSetting = $this->getDefaultJsonAsArray();
        $reader->read(json_encode($defaultSetting));

        $parsedSettings = $reader->getArray();
        $this->assertIsArray($parsedSettings);

        $this->assertEquals("Shopify connector", $parsedSettings['name']);
        $this->assertIsArray($parsedSettings['arguments']);
        $this->assertIsArray($parsedSettings['mapping']);

    }

    public function testConfigationMissingName()
    {
        $configuration = new Configuration();
        $reader = new ReaderJson($configuration);

        $defaultSetting = $this->getDefaultJsonAsArray();
        unset($defaultSetting['name']);
        $reader->read(json_encode($defaultSetting));

        $this->expectException(InvalidConfigurationException::class);
        $this->expectExceptionMessage('The child config "name" under "" must be configured.');
        $parsedSettings = $reader->getArray();
        $this->assertIsArray($parsedSettings);
    }

    private function getDefaultJsonAsArray()
    {
        return json_decode(file_get_contents(__DIR__ . "/../Resources/testConfiguration.json"), true);
    }
}
