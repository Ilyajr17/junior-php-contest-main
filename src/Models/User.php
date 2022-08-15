<?php

namespace App\Models;

class User extends Manager
{
    public $id;
    public $email;
    public $first_name;
    public $last_name;
    public $password;
    public $created_at;
    protected static $table = 'users';
    //protected $table = 'users';
    protected $sqlInsert = "INSERT INTO users (email, first_name, last_name, password, created_at) VALUES (:email, :first_name, :last_name, :password, :created_at)";

    public function getExcuteArray()
    {

        return [
            ':email' => $this->email,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':password' => $this->password,
        ];
    }
}
