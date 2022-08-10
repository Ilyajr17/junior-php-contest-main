<?php

namespace App\db\connection;

use PDO;

function createConnection()
{
    $dbPath = __DIR__ . '/../../db.sqlite';

    $db = null;

    $db = new PDO('sqlite:' . $dbPath);

    //TODO: Create connection to Sqlite DB

    return $db;
}







