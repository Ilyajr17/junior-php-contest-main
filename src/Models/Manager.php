<?php

namespace App\Models;

class Manager
{
    public function getExcuteArray()
    {
        return [];
    }

    public function save()
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        date_default_timezone_set('Europe/Samara');
        $this->created_at = date("Y-m-d H:i:s");

        $excuteArray = Manager::getExcuteArray();


        $sql = $this->sqlInsert;

        $query = $pdo->prepare($sql);
        $query->execute($excuteArray);

        $this->id = $pdo->lastInsertId();
    }


    public static function findOne(int | null $id = null)
    {
        
    }
}
