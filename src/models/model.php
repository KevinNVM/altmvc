<?php

$dbCreds = require __DIR__ . '/../database/conn.php';

function all(string $table, string|array $columns = '*')
{
    global $dbCreds;
    $conn = mysqli_connect(...$dbCreds);

    $columns = is_array($columns) ? implode(',', $columns) : $columns;
    $query = query("SELECT $columns FROM $table");
    $results  = fetch($query);

    mysqli_close($conn);

    return $results;
}

function first(string $table, string|array $columns = '*')
{
    global $dbCreds;
    $conn = mysqli_connect(...$dbCreds);
    $query = query("SELECT $columns FROM $table");
    $result = fetchOne($query);
    mysqli_close($conn);
    return $result;
}