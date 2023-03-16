<?php

namespace App\DAO;
use App\DAO\SQL;

Class MessageDAO extends SQL
{
    protected $message;

    public static function setMessage($message)
    {
        $sql = new SQL;
        return $sql->rawQuery('INSERT INTO tb_messages (message) VALUES (?)', array(
            $message
        ));
    }

    public static function getAll()
    {
        $sql = new SQL;
        return $sql->selectAll('SELECT * FROM tb_messages');
    }

    
}

?>