<?php
include "../app/database.php";


$link = connect();
select_db();


if (isset($_GET)) {
    if (str_contains($_SESSION['url'], "user")) {
        $table = "users";
        $header = '<script>window.location.replace("/test/templates/users.php")</script>';
    }else{
        $table = "foods";
        $header = '<script>window.location.replace("/test/templates/manage-food.php")</script>';
    }
    $id = (int)$_GET['id'];
    $SQL = "delete from {$table} where id =  ?";
    $stmt = mysqli_prepare($link, $SQL);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    echo $header;
}