<?php

namespace App;

use App\Models\User;
use App\Controllers\ErrorHandling;
class ShowUsers


{
    public static function show_user()
    {

        $array = [];

        $obj = new ErrorHandling();
        $validat = $obj->validateTest([
            'max-price' => ['int'],
            'min-price' => ['int']
        ]);


        if (isset($_GET['delete'])) {
            $_GET = [];
        }
        if (isset($_GET['username']) && (!empty($user_name = $_GET['username']))) {
            $array[] = "username LIKE '%{$user_name}%'";
        }
        if (isset($_GET['email']) && (!empty($email = $_GET['email']))) {
            $array[] = "email LIKE '%{$email}%'";
        }
        if (!$validat) {
            if (isset($_GET['min-price']) && !empty($min_price = $_GET['min-price']) && isset($_GET['max-price']) && !empty($max_price = $_GET['max-price'])) {
                $array[] = "price between '{$min_price}' and '{$max_price}' ";

            } elseif (isset($_GET['min-price']) && !empty($min_price = $_GET['min-price'])) {
                $array[] = "price >= '{$min_price}'";
            } elseif (isset($_GET['max-price']) && !empty($max_price = $_GET['max-price'])) {
                $array[] = "price <= '{$max_price}'";
            }
        } else {
            echo '<script>window.location.replace("/test/user.php")</script>';
        }
        $user = new User();
        if (!empty($array)) {
            $user->SQL = "where " . implode(" and ", $array);

        }
        $user->SQL .= " order by id DESC";
        $result = $user->get();
        if ($result->rowCount() != 0) {
            return $result;

        } else {
            return false;
        }

    }

}