<?php

namespace App\Models;

class Post extends Manager
{
    public $id;
    public $title;
    public $body;
    public $created_at;
    public $creator_id;
    protected $table = 'post';
    protected $sqlInsert = "INSERT INTO post (title, body, created_at, creator_id) VALUES (:title, :body, :created_at, :creator_id)";
}
