<?php
include "../app/database.php";

$link = connect();
select_db();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $SQL = "select * from foods where id = ? ";
    $stmt = mysqli_prepare($link, $SQL);
    mysqli_stmt_bind_param($stmt, 's', $id);
    mysqli_stmt_execute($stmt);

    if ($result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {


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
echo '<script>window.location.replace("/test/templates/shop.php")</script>';
