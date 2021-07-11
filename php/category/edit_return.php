<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    include("../db.php");

    $stmt = $conn->prepare("select id, catname,status from category where id=?");

    $category = $_POST['category_id'];
    $stmt->bind_param("s",$category);

    $stmt ->bind_result($id,$catname,$status);

    if($stmt->execute()){

        while($stmt->fetch()){

            $output = array("id"=>$id, "catname"=>$catname, "status"=>$status);
        }
        echo json_encode($output);

    }

    $stmt->close();


}





?>