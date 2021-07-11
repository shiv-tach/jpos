<?php

include("../db.php");

$stmt = $conn->prepare("select id,catname,status from category where status='1' order by id DESC");
$stmt->bind_result($id,$category,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id, "category"=>$category,"status"=> $status);
    }
    echo json_encode($output);
}

$stmt->close();

?>