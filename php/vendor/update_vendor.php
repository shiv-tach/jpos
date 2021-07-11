<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update vendor set vname=?,contactno=?,email=?,address=?, status=? where vender_id=?");
    $stmt->bind_param("sissii",$vname,$contactno,$email,$address,$status,$vender_id);

    $vender_id = $_POST['vendor_id'];
    $vname = $_POST['vendorname'];
    $contactno=$_POST['contactno'];
    $email=$_POST['email'];
    $address=$_POST['address'];
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