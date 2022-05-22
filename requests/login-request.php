<?php
include "../app/database.php";
include "../vendor/autoload.php";
//include "../app/Error.php";
$error_hadling = new \App\Controllers\ErrorHandling();
$link = connect();
select_db();


$validat = $error_hadling->validateTest([
    'username' => ['required', 'min:3', 'max:30'],
    'password' => ['required', 'min:3']
]);




$errors = [
    'username' => '',
    'password' => '',
];

$user = new \App\Models\User();


if (! $validat) {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = isset_request('post', 'username');
        $password = isset_request('post', 'password');
        if ($result = $user->find(compact("username"))->fetchAll(PDO::FETCH_ASSOC)[0]) {
            if ($user->is_correct($password, $result)){
                echo '<script>window.location.replace("/test/templates/")</script>';

            } else {
//                $validat = $error_hadling->validateTest([
//                    'password' => ['wrong-password']
//                ]);
//                $_SESSION['errors']['password'][] = 'رمز عبور اشتباه است!';
                echo '<script>window.location.replace("/test/templates/login.php")</script>';
            }
        } else {
//            $_SESSION['errors']['username'][] = 'نام کاربری اشتباه است!';
            echo '<script>window.location.replace("/test/templates/login.php")</script>';
        }
    }
} else {
    echo '<script>window.location.replace("/test/templates/login.php")</script>';


}






