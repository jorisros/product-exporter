<?php

namespace Transform;

use JorisRos\LibraryProductExporter\Transform\MoneyToFloat;
use PHPUnit\Framework\TestCase;

class MoneyToFloatTest extends TestCase
{
    public function testMoney()
    {
        $transform = new MoneyToFloat();
        $transform->transform('€ 1234,56');
        $this->assertEquals(1234.56, $transform->getValue());

        $transform->transform('1234,56');
        $this->assertEquals(1234.56, $transform->getValue());

        $transform->transform('1,10 USD');
        $this->assertEquals(1.10, $transform->getValue());

        $transform->transform('1 000 000.00');
        $this->assertEquals(1000000.0, $transform->getValue());

        $transform->transform('$1 000 000.21');
        $this->assertEquals(1000000.21, $transform->getValue());

        $transform->transform('£1.10');
        $this->assertEquals(1.10, $transform->getValue());

        $transform->transform('$123 456 789');
        $this->assertEquals(123456789.0, $transform->getValue());

        $transform->transform('$123,456,789.12');
        $this->assertEquals(123456789.12, $transform->getValue());

        $transform->transform('$123 456 789,12');
        $this->assertEquals(123456789.12, $transform->getValue());

        $transform->transform('1.10');
        $this->assertEquals(1.1, $transform->getValue());

        $transform->transform(',,,,.10');
        $this->assertEquals(.1, $transform->getValue());

        $transform->transform('1.000');
        $this->assertEquals(1000.0, $transform->getValue());

        $transform->transform('1,000');
        $this->assertEquals(1000.0, $transform->getValue());
    }
}