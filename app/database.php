<?php

function isset_request($method, $var)
{
    if ($method == 'post') {
        return isset($_POST[$var]) ? $_POST[$var] : null;
    } elseif ($method == 'get') {
        return isset($_GET[$var]) ? $_GET[$var] : null;
    }
}

//var_dump(users_count());

