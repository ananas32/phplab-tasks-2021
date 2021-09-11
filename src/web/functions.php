<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $firstLetters = array_unique(array_map(function ($item) {
        return $item['name'][0];
    }, $airports));

    sort($firstLetters);

    return $firstLetters;
}

function url(array $array): string
{
    return '?' . http_build_query(array_merge($_GET, $array));
}
