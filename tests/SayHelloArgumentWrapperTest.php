<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    protected $functions;

    protected function setUp(): void
    {
        $this->functions = new functions\Functions();
    }

    /**
     * @dataProvider negativeDataProvider
     * @param $input
     */
    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->sayHelloArgumentWrapper([]);
    }

    public function negativeDataProvider()
    {
        return [
            [['Hello'], ['John']],
            [[23], [2]]
        ];
    }
}
