<?php
namespace App\Controllers;
class ErrorHandling
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function validateTest($rules)
    {
        $array = [];
        foreach ($rules as $key => $rule) {
            foreach ($rule as $item) {
                if ($item == 'required' && (isset($_REQUEST[$key]) && empty($_REQUEST[$key]))) {
                    $array[$key][] = ['status' => 422, 'message' => 'required'];
                } elseif (isset($_REQUEST[$key]) && !empty($_REQUEST[$key])) {

                    if ($item == 'int' && !is_numeric($_REQUEST[$key])) {
                        $array[$key][] = ['status' => 422, 'message' => 'int'];
                    }
                    if (str_contains($item, 'max') && strlen($_REQUEST[$key]) > (int)explode(":", $item)[1]) {
                        $array[$key][] = ['status' => 422, 'message' => $item];
                    }
                    if (str_contains($item, 'min') && strlen($_REQUEST[$key]) < (int)explode(":", $item)[1]) {
                        $array[$key][] = ['status' => 422, 'message' => $item];

                    }
                }
            }
        }

        $_SESSION['errors'] = $array;
        return count($array) > 0 ? true : false;
    }

    function show_error($name = null)
    {
        $name = fa_att();
        $messages = fa_validation();
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
//        print_r($_SESSION['errors']);
            foreach ($_SESSION['errors'] as $key => $errors) {
                foreach ($errors as $error) {
                    if ($error['message'] == 'required') {
//                    print_r([$messages[$error['message']], $name[$key]]);
//                    strtr($messages[$error['message']], [{name} => $name[$key]]);
                        $validate_message = (
                        strtr(
                            $messages[$error['message']],
                            [
                                "{name}" => "$name[$key]",
                            ]
                        ));
                        echo '<div class="alert alert-danger" role="alert">' . $validate_message . "</div>";

                    }
                    if (str_contains($error['message'], 'min')) {
                        $num = (int)explode(":", $error['message'])[1];
                        $error_message = explode(":", $error['message'])[0];
                        $validate_message = (
                        strtr(
                            $messages[$error_message],
                            [
                                "{name}" => "$name[$key]",
                                "{num}" => "$num"
                            ]
                        ));
                        echo '<div class="alert alert-danger" role="alert">' . $validate_message . "</div>";
                    }
                    if (str_contains($error['message'], 'max')) {
                        $num = (int)explode(":", $error['message'])[1];
                        $error_message = explode(":", $error['message'])[0];
                        $validate_message = (
                        strtr(
                            $messages[$error_message],
                            [
                                "{name}" => "$name[$key]",
                                "{num}" => "$num"
                            ]
                        ));
                        echo '<div class="alert alert-danger" role="alert">' . $validate_message . "</div>";
                    }
                    if ($error['message'] == 'int') {
                        ;
//                    strtr($messages[$error['message']], [{name} => $name[$key]]);
                        $validate_message = (
                        strtr(
                            $messages[$error['message']],
                            [
                                "{name}" => "$name[$key]",
                            ]
                        ));
                        echo '<div class="alert alert-danger" role="alert">' . $validate_message . "</div>";

                    }
                }
            }
            unset($_SESSION['errors']);

        }

    }
}


