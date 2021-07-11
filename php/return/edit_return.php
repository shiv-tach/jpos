<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    include("../db.php");

    $stmt = $conn->prepare("select id,due from purchase where id =?");

    $category = $_POST['vendor_id'];
    $stmt->bind_param("s",$category);

    $stmt ->bind_result($id,$due);

    if($stmt->execute()){

        while($stmt->fetch()){

            $output = array("id"=>$id,"due"=>$due);
        }
        echo json_encode($output);

    }

    $stmt->close();


}





?>