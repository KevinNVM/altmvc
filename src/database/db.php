<?php

$conn = require 'conn.php';

function query($query) {
    global $conn;
    return mysqli_query($conn, $query);
} 

function fetch($queryResult, $asObject = true) {
    global $conn;
    $results = [];
    if ($asObject) {
        while($row = mysqli_fetch_object($queryResult)) {
            $results[] = $row;
        }
    } else {
        while ($row = mysqli_fetch_assoc($queryResult)) {
            $results[] = $row;
        }
    }

    return $results;
}