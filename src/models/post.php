<?php

require_once 'model.php';

define('table', 'posts');

function all_posts(string|array $columns = '*')
{
    return all(table, $columns);
}