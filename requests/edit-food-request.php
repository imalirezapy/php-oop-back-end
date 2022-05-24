<?php

$validat = (new \App\Controllers\ErrorHandling)->validateTest([
    'image' => ['required'],
    'food-name' => ['required', 'min:3'],
    'price' => ['required'],
    'description' => ['required'],
]);

if (!$validat){
    print_r($_GET);
} else{
    echo (new \App\Models\Redirect())->redirect("templates/edit-food.php");

}
