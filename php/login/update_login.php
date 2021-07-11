<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update login set username=?, password=?,status=? where id=?");
    $stmt->bind_param("ssii",$username,$password,$status,$logid );

    $logid = $_POST['brand_id'];

    $username = $_POST['username'];
    $password = $_POST['password'];
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