<?php

include('../db.php');


if($_SERVER['REQUEST_METHOD']=='POST'){

    $stmt = $conn->prepare("delete from category where id =?");

    $stmt->bind_param("s",$category_id);

    $category_id = $_POST['category_id'];


    if($stmt->execute()){

        echo 1;
    }
    else{

        echo 0;
    }

    $stmt->close();
}

?>

