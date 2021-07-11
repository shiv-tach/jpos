<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    include("../db.php");

    $stmt = $conn->prepare("select vender_id,vname,contactno,email,address,status from vendor where vender_id =?");

    $category = $_POST['vendor_id'];
    $stmt->bind_param("s",$category);

    $stmt ->bind_result($vender_id,$vname,$contactno,$email,$address,$status);

    if($stmt->execute()){

        while($stmt->fetch()){

            $output = array("vender_id"=>$vender_id,"vendorname"=>$vname, "contactno"=>$contactno,"email"=>$email,"address"=>$address ,"status"=>$status);
        }
        echo json_encode($output);

    }

    $stmt->close();


}





?>