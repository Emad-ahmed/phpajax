<?php
include 'config.php';




$name = $_POST['name'];
$email = $_POST['email'];





$insert_product = mysqli_query($conn, "INSERT INTO `student` (`name`, `email`) VALUES ('$name', '$email')");


if ($insert_product) {
    echo 1;
} else {
    echo 0;
}
?>