<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update product set product_name =?, description=?,barcode=?,category_id=?,brand_id=?,warranty=?,price_retail=?,price_cost=?,reorderlevel=?,date=?,status=? where product_id=?");
    $stmt->bind_param("ssssssssssss",$product_name, $description,$barcode,$category_id,$brand_id,$warranty,$price_retail,$price_cost,$reorderlevel,$date,$status,$product_id );

    $product_id  = $_POST['brand_id'];
    $product_name = $_POST['productName'];
    $description = $_POST['productDescription'];
    $barcode = $_POST['barcode'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $warranty = $_POST['warranty'];
    $price_retail = $_POST['retailPrice'];
    $price_cost = $_POST['costPrice'];
    $reorderlevel = $_POST['reorderLevel'];
    $date = $_POST['productDate'];
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

