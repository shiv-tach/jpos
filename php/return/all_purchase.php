<?php

include("../db.php");


$stmt = $conn->prepare("select v.vname, p.id,p.vendor_id,p.date,p.total,p.pay,p.due,p.payment_type from purchase p, vendor v where v.vender_id=p.vendor_id order by vendor_id DESC");
$stmt->bind_result($vname,$id,$vendor_id,$date,$total,$pay,$due,$payment_type);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("vname"=>$vname,"id"=>$id,"vendor_id"=>$vendor_id,"date"=>$date, "total"=>$total,"pay"=> $pay,"due"=> $due,"payment_type"=>$payment_type,);

    }
    echo json_encode($output);
}

$stmt->close();





?>