<?php

include("../db.php");

$stmt = $conn->prepare("select id,date,time,total,pay,payment_type,balance from sales order by id DESC");
$stmt->bind_result($id,$date,$time,$total,$pay,$payment_type,$balance);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id,"date"=>$date,"balance"=>$balance, "time"=>$time,"total"=>$total,"pay"=> $pay,"payment_type"=>$payment_type);
    }
    echo json_encode($output);
}

$stmt->close();

?>