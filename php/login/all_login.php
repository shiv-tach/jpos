<?php

include("../db.php");

$stmt = $conn->prepare("select id,username,password,status from login order by id DESC");
$stmt->bind_result($id,$username,$password,$status);

if($stmt->execute()){

    while($stmt->fetch()){

        $output[] = array("id"=>$id, "username"=>$username,"password"=>$password,"status"=> $status);
    }
    echo json_encode($output);
}

$stmt->close();

?>