<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    include("../db.php");

    $stmt = $conn->prepare("select id, brand,status from brand where id=?");

    $brand= $_POST['brand_id'];
    $stmt->bind_param("s",$brand);

    $stmt ->bind_result($id,$bname,$status);

    if($stmt->execute()){

        while($stmt->fetch()){

            $output = array("id"=>$id, "brand"=>$bname, "status"=>$status);
        }
        echo json_encode($output);

    }

    $stmt->close();


}





?>