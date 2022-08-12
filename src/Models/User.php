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
    protected $table = 'users';
    

}
