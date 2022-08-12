<?php

namespace App\Models;

class Post
{
    public $id;
    public $title;
    public $body;
    public $created_at;
    public $creator_id;

    public function save()
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        date_default_timezone_set('Europe/Samara');
        $this->created_at = date("Y-m-d H:i:s");

        // $this->created_at = date('Y-m-d');
        $sql = "INSERT INTO post (title, body, created_at, creator_id) VALUES (:title, :body, :created_at, :creator_id)";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':title' => $this->title,
            ':body' => $this->body,
            ':created_at' => $this->created_at,
            ':creator_id' => $this->creator_id
        ]);
        $this->id = $pdo->lastInsertId();
    }

    public static function findOne(int | null $id = null)
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        if ($id === null) {
            $query = $pdo->query('SELECT * FROM post ORDER BY id DESC LIMIT 1');
        } else {
            $sql = "SELECT * FROM post WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
        }

        $post = new Post;

        $row = $query->fetch(\PDO::FETCH_ASSOC);
        $post->id = $row['id'];
        $post->title = $row['title'];
        $post->body = $row['body'];
        $post->created_at = $row['created_at'];
        $post->creator_id = $row['creator_id'];

        return $post;
    }
}
