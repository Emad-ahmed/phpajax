<?php
include 'config.php';



$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];





$insert_product = mysqli_query($conn, "UPDATE `student` SET `name`='$name',`email`='$email' WHERE id='$id'");


if ($insert_product) {
    echo 1;
} else {
    echo 0;
}
?>