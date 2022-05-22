<?php
include "../vendor/autoload.php";
$title = 'users';
include "../view/header.php";
?>
    <div class="card-body">

    </div>
    <div class="row">
        <?php (new \App\Controllers\ErrorHandling)->show_error();?>
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <div class="col-md-2">
                            <a class="btn btn-success" href="add-user.php">افزودن کاربر جدید</a>
                        </div>
                    </div>
                    <form action="users.php" method="get">
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>نام کاربر</label>
                                    <input class="form-group" type="text" name="username" value="<?= isset($_GET['username'])? $_GET['username']: ''?>">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>ایمیل</label>
                                    <input class="form-group" type="text" name="email" value="<?= isset($_GET['email'])? $_GET['email']: ''?>">
                                </div>
                            </div>
<!--                            <div class="col-md-2">-->
<!--                                <div class="form-group">-->
<!--                                    <label>حداقل خرید</label>-->
<!--                                    <input class="form-group" type="number" name="min-price" value="--><?//= isset($_GET['min-price'])? $_GET['min-price']: ''?><!--">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-md-2">-->
<!--                                <div class="form-group">-->
<!--                                    <label>حداکثر خرید</label>-->
<!--                                    <input class="form-group" type="number" name="max-price" value="--><?//= isset($_GET['max-price'])? $_GET['max-price']: ''?><!--">-->
<!--                                </div>-->
<!--                            </div>-->
                            <div class="col-md-2">
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn btn-info">سرچ</button>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group mt-4">
                                    <a href="users.php?clear=true" type="submit" class="btn btn-danger">حذف فیلتر ها</a>
                                </div>

                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">ادمین</th>
                                <th scope="col">آپشن</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php if ($result = \App\ShowUsers::show_user()){
                                $i = 0;
//                                print_r($result->fetchAll(PDO::FETCH_ASSOC));
                                foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $id=>$food){
                                    $i++?>
                                    <tr>
                                        <th scope="row"><?= $i?></th>
                                        <td><?= $food['username'] ?></td>
                                        <td><?= $food['email'] ?></td>
                                        <?php $class = $food['isAdmin']==1?"fa-check text-success":"" ?>
                                        <td><span class="fa <?= $class?>"></span></td>
                                        <td>
                                            <a title="ویرایش" class="btn btn-success text-white btn-sm" href="edit-user.php?id=<?= $food['id']?>"><i class="fa fa-pencil"></i> </a>
                                            <a title="حذف" class="btn btn-danger text-white btn-sm" href="../requests/delete-request.php?id=<?= $food['id']?>"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                <?php }
                            } else{ ?>

                                <tr class="text-center">
                                    <th colspan="5" class="">کاربری یافت نشد</th>

                                </tr>

                            <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "../view/footer.php";
