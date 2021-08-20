<?php

namespace basics;

class Basics implements BasicsInterface
{
    private $validator;

    public function __construct()
    {
        $this->validator = new BasicsValidator();
    }

    /**
     * @param int $minute
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

        if ($minute > 0 && $minute <= 15) {
            return 'first';
        } elseif ($minute > 15 && $minute <= 30) {
            return 'second';
        } elseif ($minute > 30 && $minute <= 45) {
            return 'third';
        } else {
            return 'fourth';
        }
    }

    /**
     * @param int $year
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        return (($year % 4) === 0) && (($year % 100) !== 0) || (($year % 400) === 0);
    }

    /**
     * @param string $input
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $array = str_split($input, 3);

        return array_sum(str_split($array[0])) === array_sum(str_split($array[1]));
    }
}
