<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     * @param $expected
     */
    public function testPositive($expected)
    {
        $this->assertEquals($expected, $this->functions->sayHello());
    }

    public function positiveDataProvider()
    {
        return [
            ['Hello']
        ];
    }
}
