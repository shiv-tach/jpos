<?php

include("../db.php");

$stmt = $conn->prepare("select p.id,p.vendor_id,p.date, sum(p.total),sum(p.pay),p.payment_type,v.vname,sum(p.due) from purchase p,vendor v where p.vendor_id=v.vender_id GROUP BY p.vendor_id order by id DESC");
$stmt->bind_result($id,$date,$vendor_id,$total,$pay,$payment_type,$name,$due);




if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id,"date"=>$name,"vid"=>$date, "vendor_id"=>$vendor_id,"total"=>$total,"pay"=> $pay,"payment_type"=>$payment_type,"due"=>$due);
    }
    echo json_encode($output);
}



//$stmt2->execute();

$stmt->close();

?>