<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     * @param $expected
     * @param $input
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            [696969, 'Hello 696969'],
            ['John', 'Hello John'],
            [null, 'Hello '],
            [false, 'Hello '],
            [true, 'Hello 1']
        ];
    }
}
