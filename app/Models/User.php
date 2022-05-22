<?php

namespace App\Models;

use GuzzleHttp\Exception\TransferException;

class User extends DB
{
    protected $table = "users";

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