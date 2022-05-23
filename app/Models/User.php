<?php

namespace App\Models;

use GuzzleHttp\Exception\TransferException;

class User extends DB
{
    protected $table = "users";
    public function __construct()
    {
        parent::__construct();
        $this->creatTable($this->table,"username VARCHAR(30) NOT Null, email VARCHAR(100) NOT NULL, password text NOT NULL, isAdmin VARCHAR(100), cart TEXT");
    }

    public function is_correct($password, $result){
        if (md5($password) == $result['password']) {
            $_SESSION['user'] = ['id' => $result['id'], 'username' => $result["username"]];
            $_SESSION['login'] = true;
            $_SESSION['isAdmin'] = $result['isAdmin'] == 1 ? true : false;
            return true;
        }
        return false;

    }

}