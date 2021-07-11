<?php

include("../db.php");

$stmt = $conn->prepare("select vender_id,vname,contactno,email,address,status from vendor where status='1' order by vender_id DESC");
$stmt->bind_result($vender_id,$vname,$contactno,$email,$address,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("vender_id"=>$vender_id,"vname"=>$vname, "contactno"=>$contactno,"email"=> $email,"address"=> $address,"status"=>$status,);
    }
    echo json_encode($output);
}

$stmt->close();

?>