<?php

namespace App\Models;

class Manager
{
    public function save()
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        date_default_timezone_set('Europe/Samara');
        $this->created_at = date("Y-m-d H:i:s");

        if ($this->table === 'users') {
            $sql = "INSERT INTO users (email, first_name, last_name, password, created_at) VALUES (:email, :first_name, :last_name, :password, :created_at)";
            $query = $pdo->prepare($sql);
            $query->execute([
                ':email' => $this->email,
                ':first_name' => $this->first_name,
                ':last_name' => $this->last_name,
                ':password' => $this->password,
                ':created_at' => $this->created_at
            ]);
        }

        if ($this->table === 'post') {
            $sql = "INSERT INTO post (title, body, created_at, creator_id) VALUES (:title, :body, :created_at, :creator_id)";
            $query = $pdo->prepare($sql);
            $query->execute([
                ':title' => $this->title,
                ':body' => $this->body,
                ':created_at' => $this->created_at,
                ':creator_id' => $this->creator_id
            ]);
        }
        $this->id = $pdo->lastInsertId();
    }

    public static function findOne(int | null $id = null)
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        if (get_called_class() === 'App\Models\User') {
            if ($id === null) {
                $query = $pdo->query('SELECT * FROM users ORDER BY id DESC LIMIT 1');
            } else {
                $sql = "SELECT * FROM users WHERE id = :id";
                $query = $pdo->prepare($sql);
                $query->bindParam(':id', $id);
                $query->execute();
            }

            $user = new User;

            while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->first_name = $row['first_name'];
                $user->last_name = $row['last_name'];
                $user->password = $row['password'];
                $user->created_at = $row['created_at'];
            }
            return $user;
        }

        if (get_called_class() === 'App\Models\Post') {
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
}
