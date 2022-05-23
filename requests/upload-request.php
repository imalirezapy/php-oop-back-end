<?php
include "../app/database.php";
include "../vendor/autoload.php";
$link = connect();
select_db();
//var_dump($_SERVER['REQUEST_METHOD']);
$validat = (new \App\Controllers\ErrorHandling())->validateTest([
    'image' => ['required'],
    'food-name' => ['required', 'min:3'],
    'price' => ['required'],
    'description' => ['required'],
]);

$food = new \App\Models\Food();
//var_dump($_FILES);
if (isset($_POST)) {
    $red = new \App\Models\Redirect();
    if (isset($_POST['_method']) and $_POST['_method'] == "PUT") {


        if (! $validat) {
                $id = (int)$_POST['id'];
                if ($result = $food->find(compact("id"))->fetchAll(PDO::FETCH_ASSOC)[0]) {

                    $image = $_FILES['image']["name"][0] != '' ? $_FILES['image']["name"][0] : $_POST['image-name'];
                    $path = '../foods/' . $image;
                    move_uploaded_file($_FILES['image']['tmp_name'][0], $path);

                    $id = (int)$_POST['id'];
                    $price = (int)$_POST['price'];
                    $name = $_POST['food-name'];
                    $description = $_POST['description'];

                    $food->update(compact("id", "image","name", "price", "description"));
                    echo $red->redirect("templates/manage-food.php");

                }
            } else {
            echo $red->redirect("templates/edit-food.php");
            }
    }  else {

        if (! $validat) {

            $image = $_FILES['image']["name"];
            $path = '../foods/' . $image;
            $name = $_POST['food-name'];
            $price = (int)$_POST['price'];
            $description = $_POST['description'];

            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {


                $food->create(compact("image", "name", "price", "description"));

                echo $red->redirect("templates/manage-food.php");

            } else {
                echo $red->redirect("templates/manage-food.php");

            }

        } else {
            echo $red->redirect("templates/upload-food.php");
        }
    }
}
