<?php

namespace JorisRos\LibraryProductExporter;

use JorisRos\LibraryProductExporter\Connector\ReaderInterface;
use JorisRos\LibraryProductExporter\Processor\DefaultProcessor;
use JorisRos\LibraryProductExporter\Processor\ProcessorInterface;
use JorisRos\LibraryProductExporter\Transport\TransportInterface;

class Connector
{
    private array $configuration;
    public function __construct(
        ReaderInterface $reader,
        readonly private ProcessorInterface $processor
    ) {
        $this->configuration = $reader->getArray();
    }

    /**
     * Process an array with product data and pull that trough the processor
     *
     * @param  array $productData
     * @return array
     * @throws \Exception
     */
    public function process(array $productData): array
    {
        if (!$this->processor instanceof ProcessorInterface) {
            throw new \Exception("Processor must implement ProcessorInterface");
        }

        return $this->processor->process($productData);
    }

    /**
     * Transport the product data to destination
     *
     * @param  array $data
     * @return void
     * @throws \Exception
     */
    public function transport(array $data): void
    {
        try {
            $className = $this->configuration['transport']['class'];
            $transport = new $className($this->configuration['transport']['options']);

            if (!$transport instanceof TransportInterface) {
                throw new \Exception("Transport interface is not implemented");
            }

            $transport->transfer($data);
        } catch (\Exception $e) {
            throw  new \Exception($e->getMessage());
        }
    }
}
