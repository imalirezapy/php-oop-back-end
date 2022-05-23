<?php

namespace App\Models;

class Redirect
{
    public function redirect($url)
    {
        $array = array_slice(explode("/", $_SESSION['url']), 1);
        $length = array_search("templates", $array);
        $exec = '/' . join(array_slice($array, 0, $length)) . "/{$url}";
        return "<script>window.location.replace('{$exec}')</script>";
    }
}

