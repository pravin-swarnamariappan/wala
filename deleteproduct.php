<?php
    include 'database/dbconnect.php';
    $id = $_GET['id'];


    $sql = "DELETE FROM products WHERE id = '$id'";

    if ($con->query($sql) === TRUE) {
        header("location:admin.php");} else {
        echo "Error: " . $con->error;
    }

    $con->close();
?>