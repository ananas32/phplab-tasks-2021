<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider positiveDataProvider
     * @param $input
     * @param $expected
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->functions->countArguments(...$input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [],
                [
                    'argument_count' => 0,
                    'argument_values' => [],
                ]
            ],
            [
                ['John'],
                [
                    'argument_count' => 1,
                    'argument_values' => ['John'],
                ]
            ],
            [
                ['John', 'Johnovich'],
                [
                    'argument_count' => 2,
                    'argument_values' => ['John', 'Johnovich'],
                ]
            ],
        ];
    }
}
