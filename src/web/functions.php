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
function getUniqueFirstLetters(array $airports)
{

    $firstLetters = array_unique(array_map(function ($item) {
        return $item['name']{0};
    }, $airports));

    sort($firstLetters);

    return $firstLetters;
}

function url($page, $filter_by_first_letter, $filter_by_state, $sort)
{
    $string = '?';

    if ($page && $page !== false) {
        $string .= '&page=' . $page;
    }

    if ($filter_by_first_letter) {
        $string .= "&filter_by_first_letter={$filter_by_first_letter}";
    }

    if ($filter_by_state) {
        $string .= "&filter_by_state={$filter_by_state}";
    }

    if ($sort) {
        $string .= "&sort={$sort}";
    }

    return $string;
}

function sortByUrl($input)
{
    return url($_GET['page'], $_GET['filter_by_first_letter'], $_GET['filter_by_state'], $input);
}

function activePage($page)
{
    if ($_GET['page'] == $page || (empty($_GET['page']) && $page === 1)) {
        return ' active';
    }
    return '';
}
