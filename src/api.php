<?php

namespace App;

use App\Models\User;
use App\Models\Post;
use App\db\DB;

use GuzzleHttp\Client;


class Api
{
    public function connection()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $url = $_SERVER['REQUEST_URI'];

            $parsUrl = explode('/', $url);
            $userId = $parsUrl[3];


            $user = User::findOne($userId);
            $json = json_encode($user);

            header('Content-Type: application/json');
            echo $json;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
           
            $userData = json_decode(file_get_contents('php://input'), true);
            
            $user = new User();
            $user->email = $userData['email'];
            $user->first_name = $userData['first_name'];
            $user->last_name = $userData['last_name'];
            $user->password = $userData['password'];
            $user->save();

            $userId = User::findOne($user->id);
            $json = json_encode($userId);

            header('Content-Type: application/json');
            echo $json;
        }
    }
}
