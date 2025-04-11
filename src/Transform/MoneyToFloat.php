<?php

namespace JorisRos\LibraryProductExporter\Transform;

class MoneyToFloat implements TransformInterface
{
    private string $value;

    #[\Override]
    public function transform($value): void
    {
        $this->value = $this->getAmount($value);
    }

    private function getAmount($money): float
    {
        $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
        $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

        $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

        $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
        $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '', $stringWithCommaOrDot);

        return (float) str_replace(',', '.', $removedThousandSeparator);
    }

    #[\Override]
    public function getValue(): float
    {
        return $this->value;
    }
}
