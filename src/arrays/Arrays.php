<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * @param array $input
     * @return array
     */
    public function repeatArrayValues(array $input): array
    {
        $newArray = [];

        foreach ($input as $item) {
            $newArray += array_fill(count($newArray), $item, $item);
        }

        return $newArray;
    }

    /**
     * @param array $input
     * @return int
     */
    public function getUniqueValue(array $input): int
    {
        $unique = array_diff($input, array_diff_key($input, array_unique($input)));
        return $unique ? min($unique) : 0;
    }

    /**
     * @param array $input
     * @return array
     */
    public function groupByTag(array $input): array
    {
        $arrTags = [];
        sort($input);
        foreach ($input as $item) {
            foreach ($item['tags'] as $tag) {
                $arrTags[$tag][] = $item['name'];
            }
        }

        ksort($arrTags);

        return $arrTags;
    }
}
