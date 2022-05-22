<?php
include "../vendor/autoload.php";
$title = "manage foods";
include '../view/header.php';
include "../app/database.php";

?>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };
                <?php $_SESSION['image-uploaded'] = true?>
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <div class="row">
        <?php (new \App\Controllers\ErrorHandling)->show_error();?>
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <div class="row justify-content-end mb-3">
                        <div class="col-md-2">
                            <a class="btn btn-success" href="upload-food.php">ایجاد محصول جدید</a>
                        </div>
                    </div>
                    <form action="manage-food.php" method="get">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>نام محصول</label>
                                <input class="form-group" type="text" name="food-name" value="<?= isset($_GET['food-name'])? $_GET['food-name']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>حداقل قیمت</label>
                                <input class="form-group" type="number" name="min-price" value="<?= isset($_GET['min-price'])? $_GET['min-price']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>حداکثر قیمت</label>
                                <input class="form-group" type="number" name="max-price" value="<?= isset($_GET['max-price'])? $_GET['max-price']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>توضیحات</label>
                                <input class="form-group" type="text" name="description" value="<?= isset($_GET['description'])? $_GET['description']: ''?>">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                               <button type="submit" class="btn btn-info">سرچ</button>
                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-group mt-4">
                                <a href="manage-food.php?clear=true" type="submit" class="btn btn-danger">حذف فیلتر ها</a>
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
                                    <th scope="col">قیمت</th>
                                    <th scope="col">توضیحات</th>
                                    <th scope="col">آپشن</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($result = \App\ShowProduct::show_product()){
                                $i = 0;
                                foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $id=>$food){
                                $i++?>
                                    <tr>
                                        <th scope="row"><?= $i?></th>
                                        <td><?= $food['name'] ?></td>
                                        <td><?= $food['price'] ?></td>
                                        <td><?= substr($food['description'], 0, 80) ?></td>
                                        <td>
                                            <a title="ویرایش" class="btn btn-success text-white btn-sm" href="edit-food.php?id=<?= $food['id']?>"><i class="fa fa-pencil"></i> </a>
                                            <a title="حذف" class="btn btn-danger text-white btn-sm" href="../requests/delete-request.php?id=<?= $food['id']?>"><i class="fa fa-trash"></i> </a>
                                        </td>
                                    </tr>

                                <?php }
                                } else{ ?>

                                    <tr class="text-center">
                                        <th colspan="5" class="">غذایی برای نمایش پیدا نشد</th>

                                    </tr>

                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "../view/footer.php";?>