<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST')
{

    $stmt = $conn->prepare("Insert into login (username,password,status) values (?,?,?)");
    $stmt-> bind_param("ssi",$username,$password,$status);

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