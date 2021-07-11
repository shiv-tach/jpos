<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update product set qty=qty-? where barcode=?");
    $stmt->bind_param("ss",$qty,$barcode);

    $qty = $_POST['qty'];
    $barcode = $_POST['procode'];


    if($stmt->execute()){

        echo 1;
    }
    else{
        echo 0;
    }

    $stmt->close();

}




?>