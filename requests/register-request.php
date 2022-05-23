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
    $red = new \App\Models\Redirect();
    if (isset($_POST['_method']) and $_POST['_method'] == "PUT") {
        if (! $validat) {
            $id = (int)$_POST['id'];
            $user = new \App\Models\User();
            if ($result = $user->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0]) {

                $username = $_POST['username'];
                $email = $_POST['email'];
                $id = (int)$_POST['id'];

                $password = $_POST['password']=="Null"?$result['password']:md5($_POST['password']);
                $user->update(compact("id", "username", "email", "password"));

                echo $red->redirect("templates/users.php");
            }
        } else {
            echo $red->redirect("templates/edit-user.php");
        }
    }  else {

        if (isset($_POST['_method']) and $_POST['_method'] == "ADD") {
            $error_redirect = $red->redirect("templates/add-user.php");
            $redirect = $red->redirect("templates/users.php");
        } else {
            $error_redirect = $red->redirect("templates/register.php");
            $redirect = $red->redirect("templates/login.php");
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

                    if (empty($stmt->fetchAll(PDO::FETCH_ASSOC)[0])) {
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


