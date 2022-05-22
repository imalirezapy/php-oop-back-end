<?php
$title = 'ثبت نام';
$title = "ورود";
require_once "./../vendor/autoload.php";
$obj = (new \App\Controllers\ErrorHandling());

include '../view/header.php';
session_destroy();
?>

    <style>
        .register-box {
            margin-top:15px;
        }
    </style>

    <div class="register-box">
        <div class="register-logo">
            <b>ثبت نام در سایت</b>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">ثبت نام کاربر جدید</p>
                <?php $obj->show_error();?>
                <form action="../requests/register-request.php" method="post">
                    <input type="hidden" name="_method" value="ADD">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="نام کاربری" name="username">
                        <div class="input-group-append">
                            <span class="fa fa-user input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="ایمیل" name="email">
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="رمز عبور" name="password">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="تکرار رمز عبور" name="password-check">
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">افزودن کاربر</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

<?php include "../view/footer.php"; ?>