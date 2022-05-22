<?php

$title = "فروشگاه";
include "../vendor/autoload.php";
include '../view/header.php';
include "../app/database.php";
//error_reporting(E_ERROR | E_PARSE);
//$_SESSION['cart-data'] = [];
?>
<!-- Header-->
<!--<header class="bg-dark py-5">-->
<!--    <div class="container px-4 px-lg-5 my-5">-->
<!--        <div class="text-center text-white">-->
<!--            <h1 class="display-4 fw-bolder">Shop in style</h1>-->
<!--            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->
<!-- Section-->

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

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">

                <?php
                $result = \App\ShowProduct::show_product();
//                print_r($result->fetchAll(PDO::FETCH_ASSOC)[0]);
//                print_r($result->fetchAll(PDO::FETCH_ASSOC)[0]);
                if ($result) {
                    foreach ($result->fetchAll(PDO::FETCH_ASSOC) as $id=>$food){
                    ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-5 justify-content-center">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top ml-auto mr-auto" style="width: 200px; height: 200px" src="../foods/<?= $food['image'] ?>" height="300" width="450" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?= $food['name']?></h5>
                                    <!-- Product price-->
                                     <?= number_format($food['price'])?> تومان
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <?php if ($important->isAdmin()) {?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="manage-food.php">ویرایش</a></div>

                                <?php } else {?>
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="../requests/cart-request.php?id=<?= $food['id'] ?>">Add to cart</a></div>
                                <?php }?>
                                <!--                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="login.php">Add to cart</a></div>-->
                            </div>
                        </div>
                    </div>
                <?php
                }}?>
            </div>
        </div>

</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../dist/js/scripts.js"></script>
<?php include "../view/footer.php";?>
</body>
</html>
