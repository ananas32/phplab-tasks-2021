<?php

use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     * @param $input
     * @param $expected
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            [
                [
                    ['name' => 'A'],
                    ['name' => 'AA'],
                    ['name' => 'AAA'],
                    ['name' => 'AAAA'],
                    ['name' => 'C'],
                    ['name' => 'CC'],
                    ['name' => 'CCC'],
                    ['name' => 'CCCC'],
                    ['name' => 'B'],
                    ['name' => 'BB'],
                    ['name' => 'BBB'],
                    ['name' => 'BBBB'],
                ],
                ['A', 'B', 'C'],
            ],
            [
                [
                    ['name' => 'Key'],
                    ['name' => 'USA'],
                    ['name' => 'Rally'],
                    ['name' => 'World'],
                    ['name' => 'Anaconda'],
                ],
                ['A', 'K', 'R', 'U', 'W',],
            ]
        ];
    }
}
