<?php
include "../vendor/autoload.php";
include "../view/header.php";
include "../app/database.php";
//function show_product()
//{
//    $link = connect();
//    select_db();
//    $SQL = "select * from foods ORDER by id DESC";
//
//    if ($result = mysqli_query($link, $SQL)) {
//        return $result;
//
//    } else {
//        return false;
//    }
//}



if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $_SESSION['food-id']=$id;
    $food = new \App\Models\Food();
    $result = $food->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0];


} elseif (isset($_SESSION['food-id'])) {
    $id = $_SESSION['food-id'];
    $food = new \App\Models\Food();
    $result = $food->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0];

}
?>


<style>
    .upload-image{
        color: #0a53be;
    }
    .upload-image:hover{
        color: #00e3ff;
    }


</style>
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
<?php (new \App\Controllers\ErrorHandling)->show_error();$_SESSION['errors'] = []?>
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
                        <?php if (isset($result)) { ?>
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="id" value="<?= $result['id']?>">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- image input -->

                                <label class="upload-image">
                                    <h1 class="fw-border" style="font-size: 60px"> <span class="fa fa-file-image-o"></span></h1>
                                    <h4><span >بارگذاری عکس</span></h4>
                                    <input type="file"  class="custom-file-input" name="image[]" onchange="readURL(this);" ">
                                    <input type="hidden" name="image-name" value="<?= $result['image']?>">
                                    <img id="blah" src="foods/<?= $result['image']?>" alt="" />


                                </label>
                                <!-- /image input -->

                                <!-- number input-->
                                <div style="width: 90%">
                                    <label >
                                        <input type="text" placeholder="نام" id="numberExample" class="form-control" name="food-name" value="<?= $result['name']?>">
                                    </label>
                                </div>
                                <!-- Material input -->
                                <div style="width: 90%">
                                    <label >
                                        <input type="number" placeholder="قیمت" id="numberExample" class="form-control" name="price" value="<?= $result['price']?>">
                                    </label>
                                </div>
                                <div style="width: 90%">
                                    <label>
                                        <textarea name="description" placeholder="توضیحات" form="upload-form" style="width: 120%; height: 100px" ><?= $result['description']?></textarea>
                                    </label>
                                </div>

                                <!-- /number input-->

                            </div>
                        </div>
                        <?php } else {
//                            echo '<script>window.location.replace("/test/manage-food.php")</script>';
                            echo 'error';
                        }?>



                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent" style="padding: 0rem !important;">

                            <div class="text-center"><button class="btn btn-outline-dark mt-auto" type="submit">بارگذاری محصول</button></div>

                            <!--                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="login.php">Add to cart</a></div>-->
                        </div>
                    </form>
                </div>
            </div>

<?php }?>
        </div>
    </div>
</section>

<?php include "../view/footer.php";?>
