<?php

$_SESSION['url']=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

$_SESSION['image-uploaded'] = false;
$important = new \App\App();

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?= $title ?></title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="../dist/css/bootstrap-rtl.min.css">
    <!-- template rtl version -->
    <link rel="stylesheet" href="../dist/css/custom-style.css">
    <link
            class="jsbin"
            href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css"
            rel="stylesheet"
            type="text/css"
    />
    <script
            class="jsbin"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"
    ></script>
    <script
            class="jsbin"
            src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"
    ></script>


</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../templates/index.php" class="nav-link">خانه</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../templates/shop.php" class="nav-link">فروشگاه</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="../templates/cart.php" class="nav-link">سبدخرید</a>
            </li>
            <?php if (! $important->login()){ ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <small><a href="../templates/login.php" class="nav-link">ورود/ثبت نام</a></small>
                </li>
            <?php } else {?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../requests/logout.php" class="nav-link">خروج</a>
                </li>
            <?php }?>
        </ul>

        <!-- SEARCH FORM -->
<!--        <form class="form-inline ml-3">-->
<!--            <div class="input-group input-group-sm">-->
<!--                <input class="form-control form-control-navbar" type="search" placeholder="جستجو" aria-label="Search">-->
<!--                <div class="input-group-append">-->
<!--                    <button class="btn btn-navbar" type="submit">-->
<!--                        <i class="fa fa-search"></i>-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->

        <!-- Right navbar links -->
        <ul class="navbar-nav mr-auto">
            <!-- cart -->

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-cart-arrow-down" style="font-size: 20px"></i>
                        <span class="badge badge-danger navbar-badge"><?= isset($_SESSION['cart-data'])? count($_SESSION['cart-data']) : 0?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu dropdown-menu-left" style="width: 400px !important;">

                        <div class="dropdown-divider"></div>
                        <?php if (isset($_SESSION['cart-data']) && !empty($_SESSION['cart-data'])) {
                        foreach ($_SESSION['cart-data'] as $id=>$food) { ?>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="../foods/<?= $food['image']?>" alt="User Avatar" class="img-size-50 ml-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?= $food['name']?>
                                        <span class="float-left text-sm text-muted"><i class="font-italic"><?= number_format($food['price'])?> تومان</i></span><br>


                                    </h3>
                                    <p class="text-sm"><?= substr($food['description'], 0, 50)?></p>
                                    <p class="text-sm text-muted"></i><small>x </small><?= $food['count'] ?></p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <?php }
                        } else { ?>

                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="media-body text-center">
                                    <h3 class="text-sm">هنوز محصولی اضافه نکرده اید</h3>
                                </div>
                            </div>
                        <?php } ?>


                        <div class="dropdown-divider"></div>
                        <a href="../templates/cart.php" class="dropdown-item dropdown-footer">مشاهده سبد خرید</a>
                    </div>
                </li>
            <!-- cart -->

            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell-o"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                    <span class="dropdown-item dropdown-header">15 نوتیفیکیشن</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope ml-2"></i> 4 پیام جدید
                        <span class="float-left text-muted text-sm">3 دقیقه</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-users ml-2"></i> 8 درخواست دوستی
                        <span class="float-left text-muted text-sm">12 ساعت</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-file ml-2"></i> 3 گزارش جدید
                        <span class="float-left text-muted text-sm">2 روز</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">مشاهده همه نوتیفیکیشن</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                        class="fa fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
<!--         Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8"
            <span class="brand-text font-weight-light">پنل مدیریت</span>
        </a>

<!--         Sidebar -->
        <div class="sidebar">
            <div>
<!--                 Sidebar user panel (optional)-->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://www.gravatar.com/avatar/52f0fbcbedee04a121cba8dad1174462?s=200&d=mm&r=g" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $important->login()?$_SESSION['user']['username']:"وارد شوید"?></a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    لینک ها
                                    <i class="right fa fa-link"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../templates/index.php" class="nav-link">

                                            <i class="fa fa-home nav-icon"></i>
                                            <p>خانه</p>

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../templates/manage-food.php" class="nav-link">
                                            <i class="fa fa-shopping-bag nav-icon"></i>
                                            <p>فروشگاه</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../templates/cart.php" class="nav-link">
                                            <i class="fa fa-shopping-cart nav-icon"></i>
                                            <p>سبد خرید</p>
                                        </a>
                                    </li>
                                <?php if (! $important->login()){ ?>
                                    <li class="nav-item">
                                        <a href="../templates/login.php" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <small>ورود/ثبت نام</small>
                                        </a>
                                    </li>
                                <?php } else {?>
                                    <li class="nav-item">
                                        <a href="../requests/logout.php" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <small>خروج</small>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul>
                        </li>
                    <?php if ($important->isAdmin()){ ?>

                        <li class="nav-item has-treeview ">
                            <a href="#" class="nav-link bg-primary-gradient">
                                <i class="nav-icon fa fa-dashboard"></i>
                                <p>
                                    داشبوردها
                                    <i class="right fa fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                    <li class="nav-item bg-secondary-gradient rounded">
                                        <a href="../templates/users.php" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>کاربران</p>
                                        </a>
                                    </li>
                                    <li class="nav-item bg-secondary-gradient rounded">
                                        <a href="../templates/manage-food.php" class="nav-link">
                                            <i class="fa fa-circle-o nav-icon"></i>
                                            <p>مدیریت محصولات</p>
                                        </a>
                                    </li>

                            </ul>
                        </li>
                    <?php } ?>

                    </ul>
                </nav>

            </div>
        </div>
<!--         /.sidebar -->
    </aside>

<!--    -------------------- if loggin ----------------------->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">

        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
