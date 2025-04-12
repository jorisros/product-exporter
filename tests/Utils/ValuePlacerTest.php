<?php

namespace Utils;

use JorisRos\LibraryProductExporter\Utils\ValuePlacer;
use PHPUnit\Framework\TestCase;

class ValuePlacerTest extends TestCase
{


    public function testStringToMultiArrayWithValue()
    {
        $valuePlacer = new ValuePlacer();

        $arrLevels = $valuePlacer->stringToMultiArrayWithValue('product.variants[].price', 'value');
        $this->assertEquals('value', $arrLevels['product']['variants'][0]['price']);

        $arrLevels = $valuePlacer->stringToMultiArrayWithValue('product.variants[].taxId', 1);
        $this->assertEquals(1, $arrLevels['product']['variants'][0]['taxId']);

        $arrLevels = $valuePlacer->stringToMultiArrayWithValue('key', 'valvue');
        $this->assertArrayHasKey(
            'key',
            $arrLevels
        );

        $arrLevels = $valuePlacer->stringToMultiArrayWithValue('level1.level2', 'value');
        $this->assertArrayHasKey(
            'level1',
            $arrLevels
        );

        $this->assertArrayHasKey(
            'level2',
            $arrLevels['level1']
        );
        $this->assertEquals('value', $arrLevels['level1']['level2']);
    }
}
