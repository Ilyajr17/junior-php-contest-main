<?php

namespace App\Models;

class Manager
{
    public function save()
    {
        $pdo = \App\db\DB::getInstance()->getConnection();

        date_default_timezone_set('Europe/Samara');
        $this->created_at = date("Y-m-d H:i:s");

        $excuteArray = [
            ':email' => $this->email ?? '',
            ':first_name' => $this->first_name ?? '',
            ':last_name' =>  $this->last_name ??  '',
            ':password' =>  $this->password ?? '',
            ':title' => $this->title ?? '',
            ':body' => $this->body ?? '',
            ':created_at' => $this->created_at ?? '',
            ':creator_id' => $this->creator_id ?? ''
        ];

        foreach ($excuteArray as $key => $value) {
            if (empty($value)) {
                unset($excuteArray[$key]);
            }
        }

        $sql = $this->sqlInsert;

        $query = $pdo->prepare($sql);
        $query->execute($excuteArray);

        $this->id = $pdo->lastInsertId();
    }


    public static function findOne(int | null $id = null)
    {
        
    }
}
