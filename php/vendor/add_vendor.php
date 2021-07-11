<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $stmt = $conn->prepare("Insert into vendor (vname,contactno,email,address,status) values (?,?,?,?,?)");
    $stmt-> bind_param("sissi",$vname,$contactno,$email,$address,$status);

    $vname =$_POST['vendorname'];
    $contactno =$_POST['contactno'];
    $email=$_POST['email'];
    $address =$_POST['address'];
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