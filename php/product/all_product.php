<?php

include("../db.php");

$stmt = $conn->prepare("select product_id,product_name,description,barcode,category_id,brand_id,warranty,price_retail,price_cost,reorderlevel,qty,date,status from product order by product_id DESC");
$stmt->bind_result($product_id,$product_name,$description,$barcode,$category_id,$brand_id,$warranty,$price_retail,$price_cost,$reorderlevel,$qty,$date,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("product_id"=>$product_id, "product_name"=>$product_name,"description"=> $description,"barcode"=> $barcode,"category_id"=> $category_id,"brand_id"=> $brand_id,"warranty"=> $warranty,"price_retail"=> $price_retail,"price_cost"=> $price_cost,"reorderlevel"=> $reorderlevel,"qty"=> $qty,"date"=>$date,"status"=>$status,);
    }
    echo json_encode($output);
}

$stmt->close();

?>