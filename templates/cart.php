<?php
include "../vendor/autoload.php";
$title = "سبد خرید";
include "../view/header.php";
?>


    <div class="row no-gutters">
        <div class="col-md-8">
            <div class="product-details mr-2">
                <div class="d-flex flex-row align-items-center"><span class="ml-2"></span></div>
                <hr>
                <h6 class="mb-0">سبد خرید</h6>
                <div class="d-flex justify-content-between"><span><?= isset($_SESSION['cart-data'])? count($_SESSION['cart-data']) . "محصول در سبد خرید دارید": "هیچ محصولی در سبدخرید وجود ندارد"?></span>
                    <div class="d-flex flex-row align-items-center"><span class="text-black-50">مرتب سازی بر اساس: </span>
                        <div class="price ml-2"><span class="mr-1">قیمت</span><i class="fa fa-angle-down"></i></div>
                    </div>
                </div>
                <?php if (isset($_SESSION['cart-data']) && !empty($_SESSION['cart-data'])) { ?>
                <form action="../requests/manage-cart.php">

                <?php foreach ($_SESSION['cart-data'] as $id=>$food) { ?>

                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded form-group">
                        <div class="d-flex flex-row"><img class="rounded" src="../foods/<?= $food['image'] ?>" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block"><?= $food['name']?></span><span class="spec"><?= $food['description']?></span></div>
                        </div>
                        <div class="d-flex flex-row mx-sm-3 mb-2 w-25"><input type="number" step="1" min="1" max="99" name="name[<?= $food['id']?>]" class="form-control" value="<?= $food['count']?>""></div>

                            <div class="d-flex flex-row align-items-center"><span class="d-block"><small></small></span><span class="d-block ml-5 font-weight-bold"><?=number_format($food['price']) ?></span><a title="حذف" class="btn btn-danger text-white btn-sm" href="../requests/manage-cart.php?id=<?= $food['id']?>"><i class="fa fa-trash text-black-50"></i></a>
                            </div>
                    </div>

                <?php }?>
                    <div class="form-group mt-4">
                        <button href="manage-food.php?clear=true" type="submit" class="btn btn-success">اعمال تغییرات</button>
                    </div>
                </form>
                <?php }?>

            </div>
        </div>

    </div>


<?php include "../view/footer.php"; ?>
