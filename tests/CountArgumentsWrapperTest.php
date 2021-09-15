<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
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
    public function testNegative($input)
    {
        $this->expectException(InvalidArgumentException::class);

        $this->functions->countArgumentsWrapper(...$input);
    }

    public function negativeDataProvider(): array
    {
        return [
            [
                [true, 'true', 'string'],
            ],
            [
                ['false', 'string', 1],
            ],
            [
                ['true', 'false', ['element']],
            ],
        ];
    }
}
