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
     */
    public function testNegative($unexpectedValue): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->sayHelloArgumentWrapper($unexpectedValue);
    }

    /**
     * Use params not equal number, string or bool
     */
    public function negativeDataProvider(): array
    {
        return [
            [ null ],
            [ ['array'] ],
        ];
    }
}
