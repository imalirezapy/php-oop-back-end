<?php
namespace App;
class App
{
    public function isAdmin()
    {
        if (isset($_SESSION['isAdmin']) and $_SESSION['isAdmin'] == 1) {
            return true;
        }
        return false;
    }

    public function login()
    {
        if (isset($_SESSION['login']) and $_SESSION['login']) {
            return true;
        }
        return false;
    }
}