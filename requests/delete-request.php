<?php
include "../app/database.php";
include "../vendor/autoload.php";

$link = connect();
select_db();


if (isset($_GET)) {
    $red = new \App\Models\Redirect();
    if (str_contains($_SESSION['url'], "user")) {
        $table = new \App\Models\User();
        $header = $red->redirect("templates/users.php");
    } else {
        $table = new \App\Models\Food();
        $header = $red->redirect("templates/manage-food.php");
    }

    $id = (int)$_GET['id'];
    $table->delete(compact("id"));
    echo $header;
}