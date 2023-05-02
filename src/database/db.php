<?php

$dbCreds = require __DIR__ . '/conn.php';

function query($query)
{
    global $dbCreds;
    $conn = mysqli_connect(...$dbCreds);

    $result = mysqli_query($conn, $query);
    if ($result === false) {
        throw new Exception('Error executing query: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
    return $result;
}

function fetch($queryResult)
{
    $results = [];
    while ($row = mysqli_fetch_object($queryResult)) {
        $results[] = $row;
    }
    return $results;
}

function fetchOne($queryResult)
{
    return mysqli_fetch_object($queryResult);
}