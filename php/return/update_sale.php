<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update sales set balance=balance+?,pay=pay+? where id=?");
    $stmt->bind_param("iii",$balance,$pay,$id);

    $id = $_POST['vendor_id'];
    $balance=$_POST['payamount'];
    $pay=$_POST['payamount'];
    $date=$_POST['date'];

    if($stmt->execute()){

        echo 1;
    }
    else{
        echo 0;
    }

    $stmt->close();


    $stmt2 = $conn->prepare("Insert into sale_bill (bill_id,date,amount) values (?,?,?)");
    $stmt2-> bind_param("isi",$bill_id,$date,$amount);

    $bill_id =$_POST['vendor_id'];
    $date =$_POST['date'];
    $amount=$_POST['payamount'];


    if($stmt2->execute()){

        echo 1;
    }
    else{

        echo 0;
    }

    $stmt2->close();


}





?>