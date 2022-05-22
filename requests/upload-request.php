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

//var_dump($_FILES);
if (isset($_POST)) {

    if (isset($_POST['_method']) and $_POST['_method'] == "PUT") {


        if (! $validat) {
                $id = (int)$_POST['id'];
                $SQL = "select * from foods where id =  ?";
                $stmt = mysqli_prepare($link, $SQL);
                mysqli_stmt_bind_param($stmt, 'i', $id);
                mysqli_stmt_execute($stmt);
                if ($result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt))) {
                    $file_name = $_FILES['image']["name"][0] != '' ? $_FILES['image']["name"][0] : $_POST['image-name'];
                    $path = '../foods/' . $file_name;
                    move_uploaded_file($_FILES['image']['tmp_name'][0], $path);
                    $id = (int)$_POST['id'];
                    $SQL = "update foods set image=?, name=?, price=?, description=? where id=?";
                    $stmt = mysqli_prepare($link, $SQL);
                    $price = (int)$_POST['price'];
                    mysqli_stmt_bind_param($stmt, 'ssisi', $file_name, $_POST['food-name'], $price, $_POST['description'], $id);
                    mysqli_stmt_execute($stmt);
                    echo '<script>window.location.replace("/test/templates/manage-food.php")</script>';

                }
            } else {
                echo '<script>window.location.replace("/test/templates/edit-food.php")</script>';
            }
    }  else {

        if (! $validat) {

            $file_name = $_FILES['image']["name"];
            $path = '../foods/' . $file_name;
            $name = $_POST['food-name'];
            $price = (int)$_POST['price'];
            $description = $_POST['description'];
            if (move_uploaded_file($_FILES['image']['tmp_name'], $path)) {


                $SQL = "INSERT INTO foods (`image`, `name`,`price`, `description`) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $SQL);
                mysqli_stmt_bind_param($stmt, 'ssis', $file_name, $name, $price, $description);
                mysqli_stmt_execute($stmt);

                echo '<script>window.location.replace("/test/templates/manage-food.php")</script>';

            } else {
                echo '<script>window.location.replace("/test/templates/manage-food.php")</script>';

            }

        } else {
            echo '<script>window.location.replace("/test/templates/upload-food.php")</script>';
        }
    }
}
