<?php
include "../app/database.php";
include "../vendor/autoload.php";
//include "../app/Error.php";
$error_hadling = new \App\Controllers\ErrorHandling();
$link = connect();
select_db();


$validat = $error_hadling->validateTest([
    'username' => ['required', 'min:5', 'max:30'],
    'email' => ['required'],
    'password' => ['required', 'min:4'],
    'password_check' => ['required'],
]);


$errors = [
    'username_r' => '',
    'username' => '',
    'email' => '',
    'password' => '',
    'password-check' => '',
];

if (isset($_POST)) {
    if (isset($_POST['_method']) and $_POST['_method'] == "PUT") {
        if (! $validat) {
            $id = (int)$_POST['id'];
            $SQL = "select * from users where id =  ?";
            $stmt = mysqli_prepare($link, $SQL);
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
//            $result = mysqli_stmt_get_result($stmt);
//            print_r($result);
//            die();
            if ($result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {


                $id = (int)$_POST['id'];
                $SQL = "update users set username=?, email=?, password=? where id=?";
                $stmt = mysqli_prepare($link, $SQL);
                $password = $_POST['password']=="Null"?$result['password']:md5($_POST['password']);
                mysqli_stmt_bind_param($stmt, 'sssi', $_POST['username'], $_POST['email'],$password, $id);
                mysqli_stmt_execute($stmt);
                echo '<script>window.location.replace("/test/templates/users.php")</script>';
            }
        } else {
            echo '<script>window.location.replace("/test/templates/edit-user.php")</script>';
        }
    }  else {

        if (isset($_POST['_method']) and $_POST['_method'] == "ADD") {
            $error_redirect = '<script>window.location.replace("/test/templates/add-user.php")</script>';
            $redirect = '<script>window.location.replace("/test/templates/users.php")</script>';
        } else {
            $error_redirect = '<script>window.location.replace("/test/templates/register.php")</script>';
            $redirect = '<script>window.location.replace("/test/templates/login.php")</script>';
        }

        if (!$validat) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $username = isset_request('post', 'username');
                $email = isset_request('post', 'email');
                $password = isset_request('post', 'password');
                $password_check = isset_request('post', 'password-check');

                if ($password == $password_check) {
                    $user = new \App\Models\User();

                    $stmt = $user->find(compact("username"));

                    if (!$result = $stmt->fetchAll(PDO::FETCH_ASSOC)[0]) {
                        $password = md5($password);
                        $user = new \App\Models\User();
                        $user->create(compact('username', 'email', 'password'));
                        echo $redirect;
                        if (!mysqli_stmt_execute($stmt)) {
                            array_push($errors, 'مشکلی پیش آمده!');
                            echo $error_redirect;

                        }
                    } else {
                        $errors['username_r'] = 'نام کاربری تکراری است!';
                        echo $error_redirect;

                    }
                } else {
                    $errors['password-check'] = "پسورد ها برابر نیستند!";
                    echo $error_redirect;

                }
            }

        } else {
            echo $error_redirect;
        }
    }

}

//$_SESSION['errors'] = $errors;


