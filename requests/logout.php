<?php
include "../vendor/autoload.php";
$_SESSION['login'] = false;
$_SESSION['isAdmin'] = false;

echo (new \App\Models\Redirect())->redirect("templates/login.php");