<?php


include("../db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {


    $stmt = $conn->prepare("insert into purchase(vendor_id,date,total,pay,due,payment_type) values (?,?,?,?,?,?)");
    $stmt->bind_param("issssi",$vendor_id,$date,$total,$pay,$due,$payment_type);

    $vendor_id = $_POST['vendor'];
    $date= date("Y-m-d");
    $total= $_POST['total'];
    $pay= $_POST['pay'];
    $due= $_POST['Due'];
    $payment_type= $_POST['pstatus'];


}

if($stmt->execute()){


    $last_id = $conn->insert_id;


}

    $relation_list = $_POST['data'];


for($x=0;$x<count($relation_list);$x++)
{

    $stmt1 = $conn->prepare("insert into purchase_item(purchase_id,product_id,buy_price,qty,total) values (?,?,?,?,?)");
    $stmt1->bind_param("iisss",$last_id ,$product_id,$buy_price,$qty,$total);


    $product_id =$relation_list[$x]['procode'];
    $buy_price=$relation_list[$x]['price'];
    $qty=$relation_list[$x]['qty'];
    $total=$relation_list[$x]['tot_cost'];


    if($stmt1->execute()){



    }
    else{


    }

    $stmt1->close();

}

echo json_encode(array("last_id"=>$last_id ));


$stmt->close();




?>