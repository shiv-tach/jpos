<?php

include('../db.php');


if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $conn->prepare("delete from vendor where vender_id =?");

    $stmt->bind_param("s",$category_id);

    $category_id = $_POST['vendor_id'];


    if($stmt->execute()){

        echo 1;
    }
    else{

        echo 0;
    }

    $stmt->close();
}

?>
