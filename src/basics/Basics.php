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

        if ((($year % 4) === 0) && (($year % 100) !== 0) || (($year % 400) === 0)) {
            return true;
        }

        return false;
    }

    /**
     * @param string $input
     * @return boolean
     * @throws \InvalidArgumentException
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $stringLength = strlen($input);
        $sum1 = 0;
        $sum2 = 0;

        for ($i = 0, $j = $stringLength - 1; $i < $stringLength / 2; $i++, $j--) {
            $sum1 += (int)$input[$i];
            $sum2 += (int)$input[$j];
        }

        if ($sum1 === $sum2) {
            return true;
        }

        return false;
    }
}
