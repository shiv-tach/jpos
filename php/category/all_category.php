<?php

include("../db.php");

$stmt = $conn->prepare("select id,catname,status from category order by id DESC");
$stmt->bind_result($id,$catname,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id, "catname"=>$catname,"status"=> $status);
    }
    echo json_encode($output);
}

$stmt->close();

?>