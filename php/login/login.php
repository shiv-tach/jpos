<?php

include("../db.php");

$username =$_POST['username'];
$password =$_POST['password'];

$stmt = $conn->prepare("select status from login where username='$username' and password ='$password'");
$stmt->bind_result($status);
$stmt->execute();
$stmt->fetch();

if($status == 1){

    echo 1;
}
else if($status == 2){

    echo 2;
}
else{

    echo 3;

}


$stmt->close();

?>