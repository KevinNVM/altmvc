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
    return $result;
}

function fetch($queryResult, bool $asObject = true)
{
    $results = [];
    if ($asObject) {
        while ($row = mysqli_fetch_object($queryResult)) {
            $results[] = $row;
        }
    } else {
        while ($row = mysqli_fetch_assoc($queryResult)) {
            $results[] = $row;
        }
    }

    return $results;
}