<?php

namespace App\Models;

class User
{
    public $id;
    public $email;
    public $first_name;
    public $last_name;
    public $password;
    public $created_at;

    public function save()
    {
        $pdo = \App\db\DB::getInstance()->getConnection();
        $this->created_at = date('Y-m-d');
        $sql = "INSERT INTO users (email, first_name, last_name, password, created_at) VALUES (:email, :first_name, :last_name, :password, :created_at)";
        $query = $pdo->prepare($sql);
        $query->execute([
            ':email' => $this->email,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':password' => $this->password,
            ':created_at' => $this->created_at
        ]);
        $this->id = $pdo->lastInsertId();
    }

    public static function findOne(int | null $id = null)
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

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
}
