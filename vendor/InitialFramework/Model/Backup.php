<?php

namespace IF\Model;

use App\Connection;
use IF\Model\DAO;

class Backup extends DAO{

    protected $path = "../Config/Backup";
    
    public function __construct()
    {
        parent::__construct(Connection::getDB());
    }

    
}
