<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $conn->prepare("insert into vendor_payments (vendor_id,bill_id,payment) values ?,?,?");
    $stmt->bind_param("iii",$vendor_id,$bill_id,$payment);

    $date= date("Y-m-d");
    $vendor_id = $_POST['ven_id'];
    $pay = $_POST['ven_pay'];
    $bill_id=11;

    if($stmt->execute()){

        echo 1;
    }
    else{
        echo 0;
    }

    $stmt->close();

}
