<?php

include("../db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){


    $stmt = $conn->prepare("update brand set brand=?, status=? where id=?");
    $stmt->bind_param("sss",$catname,$status,$category_id );

    $category_id = $_POST['brand_id'];

    $catname = $_POST['brandname'];
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