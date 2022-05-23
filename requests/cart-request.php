<?php
include "../app/database.php";
include "../vendor/autoload.php";
$link = connect();
select_db();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $food = new \App\Models\Food();

    if ($result = $food->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0]) {


        if (! isset($_SESSION['cart-data'])) {
            $_SESSION['cart-data'] = [];
        }
        if (array_key_exists($id, $_SESSION['cart-data'])) {
            $_SESSION['cart-data'][$id]['count'] += 1;
        } else {
            $result['count'] = 1;
            $_SESSION['cart-data'][$id] = $result;
        }
    }
}
$red = new \App\Models\Redirect();
echo $red->redirect("templates/shop.php");

