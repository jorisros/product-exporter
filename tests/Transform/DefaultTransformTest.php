<?php

namespace Transform;

use JorisRos\LibraryProductExporter\Transform\DefaultTransform;
use PHPUnit\Framework\TestCase;

class DefaultTransformTest extends TestCase
{
    public function testTransform(): void
    {
        $transform = new DefaultTransform();
        $transform->transform(['value' => 1]);
        $this->assertIsArray($transform->getValue());

        $transform = new DefaultTransform();
        $transform->transform('string');
        $this->assertEquals('string', $transform->getValue());
        $this->assertIsString($transform->getValue());

        $transform = new DefaultTransform();
        $transform->transform(100);
        $this->assertEquals(100, $transform->getValue());
        $this->assertIsInt($transform->getValue());

        $transform = new DefaultTransform();
        $transform->transform(10.00);
        $this->assertEquals(10.00, $transform->getValue());
        $this->assertIsFloat($transform->getValue());

        $transform = new DefaultTransform();
        $transform->transform(true);
        $this->assertTrue($transform->getValue());
        $this->assertIsBool($transform->getValue());

        $transform = new DefaultTransform();
        $transform->transform(false);
        $this->assertFalse($transform->getValue());
        $this->assertIsBool($transform->getValue());
    }
}
