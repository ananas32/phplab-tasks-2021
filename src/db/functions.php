<?php

function url(array $array): string
{
    return '?' . http_build_query(array_merge($_GET, $array));
}

function getUniqueFirstLetters(object $pdo): array
{
    $query = $pdo->prepare('SELECT LEFT(name, 1) as first_letter from airports GROUP BY first_letter ORDER BY first_letter ASC');
    $query->setFetchMode(\PDO::FETCH_ASSOC);
    $query->execute();
    return array_column($query->fetchAll(), 'first_letter');
}

function airportCount(object $pdo, string $filterQuery, array $params): int
{
    $sql = <<<SQL
        SELECT 
            COUNT(*) AS airports_count 
        FROM 
            airports AS a 
        INNER JOIN states AS s ON a.state_id = s.id
        INNER JOIN cities AS c ON a.city_id = c.id
        $filterQuery;   
    SQL;
    $query = $pdo->prepare($sql);
    $query->setFetchMode(\PDO::FETCH_ASSOC);
    $query->execute($params);
    return $query->fetchColumn();
}

function getAirports(object $pdo, $filterQuery, array $params, int $perPage, $offset): array
{
    $sql = <<<SQL
        SELECT
            a.name, a.code, s.name AS state_name, c.name AS city_name, a.address, a.timezone 
        FROM 
            airports AS a
        INNER JOIN states AS s ON a.state_id = s.id
        INNER JOIN cities AS c ON a.city_id = c.id
        $filterQuery
        LIMIT $perPage
        OFFSET $offset;
    SQL;

    $query = $pdo->prepare($sql);
    $query->setFetchMode(\PDO::FETCH_ASSOC);
    $query->execute($params);

    return $query->fetchAll();
}

function getOffset(int $page, int $perPage): int
{
    return $page > 1 ? $perPage * ($page - 1) : 0;
}

function dd(...$array)
{
    dump($array);
    die;
}

function dump(...$array)
{
    foreach ($array as $item) {
        echo '<pre>';
        print_r($item);
        echo '</pre>';
    }
}
