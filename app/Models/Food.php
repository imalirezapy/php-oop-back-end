<?php

namespace App\Models;

class Food extends DB
{
    protected $table = "foods";
    public function __construct()
    {
        parent::__construct();
        $this->creatTable($this->table, "image text NOT Null, name VARCHAR(150) NOT NULL, price INT(11) NOT NULL, description TEXT NOT NULL");
    }
}

