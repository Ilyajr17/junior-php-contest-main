<?php

namespace App\db\initial;

function initializeDb($db)
{
    $sqlCommands = [
        'CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY,
            email TEXT,
            first_name TEXT,
            last_name TEXT,
            password TEXT,
            created_at INTEGER
            )',
        'CREATE TABLE IF NOT EXISTS post (
            id INTEGER PRIMARY KEY,
            title TEXT,
            body TEXT,
            created_at INTEGER,
            creator_id INTEGER,
            FOREIGN KEY (creator_id)  REFERENCES users(id)
            )'
    ];


    foreach ($sqlCommands as $sqlCommand) {
        $db->exec($sqlCommand);
    }

    //TODO: Create initial tables
}
