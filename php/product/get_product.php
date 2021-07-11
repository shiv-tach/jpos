<?php

include("../db.php");

$stmt = $conn->prepare("select product_id,product_name,description,barcode,category_id,brand_id,warranty,price_retail,price_cost,reorderlevel,date,status,qty from product where barcode=? order by product_id DESC");

$barcode = $_POST['procode'];
$stmt->bind_param("s",$barcode);

$stmt->bind_result($product_id,$product_name,$description,$barcode,$category_id,$brand_id,$warranty,$price_retail,$price_cost,$reorderlevel,$date,$status,$qty);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("product_id"=>$product_id, "product_name"=>$product_name,"description"=> $description,"barcode"=> $barcode,"category_id"=> $category_id,"brand_id"=> $brand_id,"warranty"=> $warranty,"price_retail"=> $price_retail,"price_cost"=> $price_cost,"reorderlevel"=> $reorderlevel,"date"=>$date,"status"=>$status,"qty"=>$qty);
    }
    echo json_encode($output);
}

$stmt->close();

?>