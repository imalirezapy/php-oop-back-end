<?php
$title = 'ثبت نام';
$title = "ورود";
require_once "./../vendor/autoload.php";
$obj = (new \App\Controllers\ErrorHandling());

include '../view/header.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $food = new \App\Models\User();
    $result = $food->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0];

}
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
                <?php (new \App\Controllers\ErrorHandling)->show_error();$_SESSION['errors'] = []?>
                <form action="../requests/register-request.php" method="post">
                <?php if (isset($result)) { ?>
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="<?= $result['id']?>">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="نام کاربری" name="username" value="<?= $result['username']?>">
                        <div class="input-group-append">
                            <span class="fa fa-user input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="ایمیل" name="email" value="<?= $result['email']?>">
                        <div class="input-group-append">
                            <span class="fa fa-envelope input-group-text"></span>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="رمز عبور" name="password" value="Null">

                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                    </div>
                        <input type="hidden" name="check-password" value="<?= $result['password']?>">

                    <div class="row">
                        <div class="col-8">
                            <div class="checkbox icheck">
                                <label>
                                    <input type="checkbox"> با <a href="#">شرایط</a> موافق هستم
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">ثبت نام</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <?php }?>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

<?php include "../view/footer.php"; ?>