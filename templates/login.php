<?php
$title = "ورود";
require_once "./../vendor/autoload.php";

$obj = (new \App\Controllers\ErrorHandling());

include '../view/header.php';

session_destroy();
?>

<div class="login-box" style="margin-top: 15px">
    <div class="login-logo">
        <b>ورود به سایت</b>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">فرم زیر را تکمیل کنید و ورود بزنید</p>
            <?php
            $obj->show_error();
            ?>
            <form action="../requests/login-request.php" method="post">
                <small class="span-error text-danger">

                </small>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="نام کاربری" name="username">
                    <div class="input-group-append">
                        <span class="fa fa-envelope input-group-text"></span>
                    </div>
                </div>
                <small class="span-error text-danger">

                </small>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="رمز عبور" name="password">
                    <div class="input-group-append">
                        <span class="fa fa-lock input-group-text"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> یاد آوری من
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <a href="#" class="btn btn-block btn-primary">
                    <i class="fa fa-facebook mr-2"></i> ورود با اکانت فیسوبک
                </a>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fa fa-google-plus mr-2"></i> ورود با اکانت گوگل
                </a>
            </div>
            <!-- /.social-auth-links -->

            <p class="mb-1">
                <a href="#">رمز عبورم را فراموش کرده ام.</a>
            </p>
            <p class="mb-0">
                <a href="register.php" class="text-center">ثبت نام</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<?php

include '../view/footer.php';
?>
