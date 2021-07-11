<?php

include("../db.php");

$stmt = $conn->prepare("select product_name,barcode,price_retail,qty,date from product");
$stmt->bind_result($product_name,$barcode,$price_retail,$qty,$date);
$setdate = date_default_timezone_set("Asia/Colombo");
$dateToday = date("Y-m-d");
if($stmt->execute()){




    while($stmt->fetch()){


        $date1=date_create($dateToday);
        $date2=date_create($date);
        $diff=date_diff($date1,$date2);
        $diff =$diff->format("%R%a days");


        $number =preg_replace('/[^0-9.-]+/', '', $diff);

        $output[] = array("pname"=>$product_name,"barcode"=>$barcode, "retail"=>$price_retail,"qty"=> $date,"date"=> $number,);
    }
    echo json_encode($output);
}

$stmt->close();

?>