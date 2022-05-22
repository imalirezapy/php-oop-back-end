<?php
$link = mysqli_connect('localhost:3306', 'root', '');

function connect(){
    global $link;
    if (! $link) {
        echo 'could not connect : ' . mysqli_connect_error();
        return exit;
    }
    return $link;
}


function select_db() {
    global $link;
    if (! $select = mysqli_select_db($link, 'test')) {
        echo 'test not found';
        return false;
    }
    return $select;
}

function isset_request($method, $var)
{
    if ($method == 'post') {
        return isset($_POST[$var]) ? $_POST[$var] : null;
    } elseif ($method == 'get') {
        return isset($_GET[$var]) ? $_GET[$var] : null;
    }
}
function users_count(){
    global $link;
    select_db();
    $SQL = 'SELECT *  FROM users';
    $result = mysqli_fetch_all(mysqli_query($link, $SQL));
    return count($result)-1;
}



//var_dump(users_count());

