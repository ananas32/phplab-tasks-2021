<?php
require_once './functions.php';

$airports = require './airports.php';

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */
$filter_by_first_letter = $_GET['filter_by_first_letter'];
if ($filter_by_first_letter) {
    $airports = array_filter($airports, function ($item) use ($filter_by_first_letter) {
        return $item['name'][0] == $filter_by_first_letter;
    });
}

$filter_by_state = $_GET['filter_by_state'];
if ($filter_by_state) {
    $airports = array_filter($airports, function ($item) use ($filter_by_state) {
        return $item['state'] == $filter_by_state;
    });
}

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */
$sortedFields = ['name', 'code', 'state', 'city'];
$sortBy = $_GET['sort'];
if (in_array($sortBy, $sortedFields)) {
    usort($airports, function ($a, $b) use ($sortBy) {
        return $a[$sortBy] <=> $b[$sortBy];
    });
}


// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */
$per_page = 5;
$offset = $_GET['page'] ? ($_GET['page'] * 5) - 1 : 0;
$count_pages = count($airports) / $per_page;
if (count($airports) % $per_page === 0) {
    $count_pages++;
}
$airports = array_slice($airports, $offset, $per_page);
$page = $_GET['page'] ?? 1;
$i_min = max(1, $page - 3);
$i_max = min($i_min + 6, $count_pages);
$i_min = max(1, $i_max - 6);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->


    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="<?= url(false, $letter, $_GET['filter_by_state'], $_GET['sort']) ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="/src/web" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col">
                <a href="<?= sortByUrl('name') ?>">Name</a>
            </th>
            <th scope="col">
                <a href="<?= sortByUrl('code') ?>">Code</a>
            </th>
            <th scope="col">
                <a href="<?= sortByUrl('state') ?>">State</a>
            </th>
            <th scope="col">
                <a href="<?= sortByUrl('city') ?>">City</a>
            </th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td>
                    <a href="<?= url($_GET['page'], $_GET['filter_by_first_letter'], $airport['state'], $_GET['sort']) ?>"><?= $airport['state'] ?></a>
                </td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <?php for ($i = $i_min; $i <= $i_max; $i++) { ?>
                <li class="page-item <?= activePage($i) ?> <?= $i ?>">
                    <a class="page-link"
                       href="<?= url($i, $_GET['filter_by_first_letter'], $_GET['filter_by_state'], $_GET['sort']) ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>

</main>
</html>
