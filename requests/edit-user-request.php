<?php
include "../vendor/autoload.php";
include "../app/database.php";


$validat = (new \App\Controllers\ErrorHandling)->validateTest([
    'username' => ['required'],
    'email' => ['required', 'min:3'],
    'password' => ['required'],
    'password-check' => ['required'],
]);

if (!$validat){
    print_r($_GET);
} else{
    echo (new \App\Models\Redirect())->redirect("templates/edit-user.php");

}