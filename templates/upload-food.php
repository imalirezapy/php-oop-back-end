<?php
include "../vendor/autoload.php";
$title = "فروشگاه";
include '../view/header.php';
include "../app/database.php";
$error = (new \App\Controllers\ErrorHandling)
?>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(450)
                        .height(300);
                };
                <?php $_SESSION['image-uploaded'] = true?>
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>




    <style>
        .upload-image{
            color: #0a53be;
        }
        .upload-image:hover{
            color: #00e3ff;
        }


    </style>
<?php $error->show_error();$_SESSION['errors'] = []?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php if ($important->isAdmin()){ ?>

                    <div class="col mb-5">

                        <div class="card h-100">
                            <form action="../requests/upload-request.php" class="form-group" id="upload-form" enctype="multipart/form-data" method="post">

                                <!-- Product image-->

                                <!--                                <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />-->

                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- image input -->
                                        <!--                                        --><?php //var_dump($_SESSION['image-uploaded']);?>
                                        <!--                                        --><?php //if (isset($_SESSION['image-uploaded']) && $_SESSION['image-uploaded'] == false){?>
                                        <label class="upload-image">
                                            <h1 class="fw-border" style="font-size: 60px"> <span class="fa fa-file-image-o"></span></h1>
                                            <h4><span >بارگذاری عکس</span></h4>
                                            <input type="file"  class="custom-file-input" name="image" onchange="readURL(this);">
                                            <!--                                            --><?php //}?>
                                            <img id="blah" src="#" alt="" />
                                            <!--                                        --><?php //if (isset($_SESSION['image-uploaded']) && $_SESSION['image-uploaded'] == true){?>

                                        </label>
                                        <!--                                        --><?php //}?>
                                        <!-- /image input -->

                                        <!-- number input-->
                                        <div style="width: 90%">
                                            <label >
                                                <input type="text" placeholder="نام" id="numberExample" class="form-control" name="food-name">
                                            </label>
                                        </div>
                                        <!-- Material input -->
                                        <div style="width: 90%">
                                            <label >
                                                <input type="number" placeholder="قیمت" id="numberExample" class="form-control" name="price">
                                            </label>
                                        </div>
                                        <div style="width: 90%">
                                            <label>
                                                <textarea name="description" placeholder="توضیحات" form="upload-form" style="width: 120%; height: 100px"></textarea>
                                            </label>
                                        </div>

                                        <!-- /number input-->

                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent" style="padding: 0rem !important;">

                                    <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="submit">بارگذاری محصول</button></div>

                                    <!--                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="login.php">Add to cart</a></div>-->
                                </div>
                            </form>
                        </div>
                    </div>

                <?php } ?>

            </div>
        </div>
    </section>
<?php include "../view/footer.php";?>