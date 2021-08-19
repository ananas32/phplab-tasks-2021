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
        $array = array_filter(array_count_values($input), function ($value) {
            return $value === 1;
        });

        ksort($array);

        return array_key_first($array) ?? 0;
    }

    /**
     * @param array $input
     * @return array
     */
    public function groupByTag(array $input): array
    {
        $arrTags = [];
        array_walk_recursive($input, function ($item, $key) use (&$arrTags) {
            if (is_numeric($key)) {
                array_push($arrTags, $item);
            }
        });

        $arrTags = array_unique($arrTags);
        sort($arrTags);
        $arrTags = array_flip($arrTags);

        foreach ($arrTags as $key => $tag) {
            $list = [];
            foreach ($input as $array) {
                if (in_array($key, $array['tags'])) {
                    array_push($list, $array['name']);
                }
            }
            $arrTags[$key] = $list;
            sort($arrTags[$key]);
        }

        return $arrTags;
    }
}
