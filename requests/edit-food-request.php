<?php
include "../vendor/autoload.php";
include "../app/database.php";


$validat = (new \App\Controllers\ErrorHandling)->validateTest([
    'image' => ['required'],
    'food-name' => ['required', 'min:3'],
    'price' => ['required'],
    'description' => ['required'],
]);

if (!$validat){
    print_r($_GET);
} else{
    echo '<script>window.location.replace("/test/templates/edit-food.php")</script>';

}
