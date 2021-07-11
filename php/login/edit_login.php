<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    include("../db.php");

    $stmt = $conn->prepare("select id, username,password,status from login where id=?");

    $brand= $_POST['brand_id'];
    $stmt->bind_param("s",$brand);

    $stmt ->bind_result($id,$username,$password,$status);

    if($stmt->execute()){

        while($stmt->fetch()){

            $output = array("id"=>$id, "username"=>$username,"password"=>$password, "status"=>$status);
        }
        echo json_encode($output);

    }

    $stmt->close();


}





?>