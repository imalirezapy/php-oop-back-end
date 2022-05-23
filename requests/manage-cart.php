<?php
include "../vendor/autoload.php";
if (isset($_GET['id'])){

    if (isset($_SESSION['cart-data']) && array_key_exists($_GET['id'], $_SESSION['cart-data'])){
        unset($_SESSION['cart-data'][$_GET['id']]);
    }
}elseif (isset($_GET['name'])){
    foreach ($_GET['name'] as $id=>$count) {
        if (isset($_SESSION['cart-data']) && array_key_exists($id, $_SESSION['cart-data'])) {
            $_SESSION['cart-data'][$id]["count"] = $count;
        }
    }
}
echo '<script>window.location.replace("/test/templates/cart.php")</script>';
