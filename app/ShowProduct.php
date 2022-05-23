<?php

namespace App;

use App\Controllers\ErrorHandling;
use App\Models\Food;
use App\Models\Redirect;

class ShowProduct
{

    public static function show_product()
    {
        $food = new Food();
        $array = [];

        $obj = new ErrorHandling();
        $validat = $obj->validateTest([
            'max-price' => ['int'],
            'min-price' => ['int']
        ]);


        if (isset($_GET['delete'])) {
            $_GET = [];
        }
        if (isset($_GET['food-name']) && (!empty($food_name = $_GET['food-name']))) {
            $array[] = "name LIKE '%{$food_name}%'";
        }

        if (isset($_GET['description']) && !empty($description = $_GET['description'])) {
            $array[] = "description LIKE '%{$description}%'";
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
            echo (new Redirect())->redirect("manage-food.php");
        }


        if (!empty($array)) {
            $food->SQL = "where " . implode(" and ", $array);
        }
        $food->SQL .= " order by id DESC";
        $result = $food->get();
//        var_dump((new Redirect())->redirect("manage-food.php"));
        if ($result->rowCount() != 0) {
            return $result;

        } else {
            return false;
        }

    }

}