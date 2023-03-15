<?php

namespace App\DAO;

use App\Connection;
use IF\Model\DAO;

Class SQL extends DAO
{
    protected $db;

    public function __construct()
    {
        $this->db = Connection::getDB();
    }
}

?>