<?php

namespace basics;

class BasicsValidator implements BasicsValidatorInterface
{
    /**
     * @param int $minute
     * @throws \InvalidArgumentException
     */
    public function isMinutesException(int $minute): void
    {
        if ($minute < 0 || $minute > 60) {
            throw new \InvalidArgumentException($minute . ' is negative of greater then 60');
        }
    }

    /**
     * @param int $year
     * @throws \InvalidArgumentException
     */
    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException($year . ' is lower then 1900');
        }
    }

    /**
     * @param string $input
     * @throws \InvalidArgumentException
     */
    public function isValidStringException(string $input): void
    {
        if (strlen($input) != 6) {
            throw new \InvalidArgumentException($input . ' contains more then 6 digits.');
        }
    }
}
