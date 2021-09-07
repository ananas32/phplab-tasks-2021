<?php
/**
 * TODO
 *  Open web/airports.php file
 *  Go through all airports in a loop and INSERT airports/cities/states to equivalent DB tables
 *  (make sure, that you do not INSERT the same values to the cities and states i.e. name should be unique i.e. before INSERTing check if record exists)
 */

/** @var \PDO $pdo */
require_once './pdo_ini.php';

function import($pdo, $item, $table, $key)
{
    // To check if item with this name exists in the DB we need to SELECT it first
    $sth = $pdo->prepare('SELECT id FROM ' . $table . ' WHERE name = :name');
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute(['name' => $item[$key]]);
    $row = $sth->fetch();

    // If result is empty - we need to INSERT
    if (!$row) {
        $sth = $pdo->prepare('INSERT INTO ' . $table . ' (name) VALUES (:name)');
        $sth->execute(['name' => $item[$key]]);

        // We will use this variable to INSERT airport
        return $pdo->lastInsertId();
    }

    // We will use this variable to INSERT airport
    return $row['id'];
}

foreach (require_once('../web/airports.php') as $item) {
    // Cities
    $cityId = import($pdo, $item, 'cities', 'city');

    // States
    $stateId = import($pdo, $item, 'states', 'state');

    // Airports
    $sth = $pdo->prepare('INSERT INTO airports (name, code, address, timezone, city_id, state_id) VALUES (:name, :code, :address, :timezone, :city_id, :state_id)');
    $sth->execute([
        'name' => $item['name'],
        'code' => $item['code'],
        'address' => $item['address'],
        'timezone' => $item['timezone'],
        'city_id' => $cityId,
        'state_id' => $stateId
    ]);
}
