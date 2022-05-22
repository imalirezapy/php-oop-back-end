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
    echo '<script>window.location.replace("/test/templates/edit-user.php")</script>';

}