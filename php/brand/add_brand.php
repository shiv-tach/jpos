<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $stmt = $conn->prepare("Insert into brand (brand,status) values (?,?)");
    $stmt-> bind_param("si",$brand,$status);

    $brand = $_POST['brandname'];

    $status = $_POST['status'];

    if($stmt->execute()){

        echo 1;
    }
    else{

        echo 0;
    }

    $stmt->close();
}






?>