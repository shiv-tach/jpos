<?php

include("../db.php");

$stmt = $conn->prepare("select id,brand,status from brand order by id DESC");
$stmt->bind_result($id,$brandname,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id, "brand"=>$brandname,"status"=> $status);
    }
    echo json_encode($output);
}

$stmt->close();

?>