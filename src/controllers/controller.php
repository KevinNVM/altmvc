<?php


// Load all controllers file in this folder.
foreach (glob(__DIR__ . "/*.php") as $filename)
{
    require_once($filename);
}
