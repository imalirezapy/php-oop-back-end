<?php
$title = "خانه";
include "../vendor/autoload.php";
include "../app/database.php";
//error_reporting(E_ERROR | E_PARSE);
include '../view/header.php';

?>

<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa fa-gear"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">ترافیک Cpu</span>
                <span class="info-box-number">
                  10
                  <small>%</small>
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">لایک‌ها</span>
                <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa fa-shopping-cart"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">فروش</span>
                <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">اعضای جدید</span>
                <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>

<div class="row">
    <div class="col-md-6">

        <!-- PRODUCT LIST -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">محصولات تازه اضافه شده</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php if ($result = \App\ShowProduct::show_product()){
                        $i = 0;
                        foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $id=>$food){
                            $i++?>
                    <!-- /.item -->
                        <li class="item">
                            <div class="product-img">
                                <img src="../foods/<?= $food['image'] ?>" alt="Product Image" class="img-size-50">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title"><?=$food['name'];?>
                                    <span class="badge badge-info float-left">تومان <?= number_format($food['price'])  ?></span></a>
                                <span class="product-description">
                             <?= $food['description'] ?>
                          </span>
                            </div>
                        </li>

                    <?php }
                    }?>
                </ul>
            </div>
            <!-- /.card-body -->
            <?php if ($important->login() and $important->isAdmin()){ ?>
                <div class="card-footer text-center">
                    <a href="manage-food.php" class="uppercase">نمایش همه محصولات</a>
                </div>
            <?php } else { ?>
                <div class="card-footer text-center">
                    <a href="shop.php" class="uppercase">نمایش همه محصولات</a>
                </div>
            <?php }?>

            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<?php

include '../view/footer.php';
?>