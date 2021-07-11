<?php


include("../db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    date_default_timezone_set("Asia/Colombo");

    $stmt = $conn->prepare("insert into sales(id,date,time,total,pay,balance,payment_type) values (?,?,?,?,?,?,?)");
    $stmt->bind_param("isssssi",$vendor_id,$date,$time,$total,$pay,$balance,$payment_type);

    $date= date("Y-m-d");

    $time=date("h:i:sa");
    $total= $_POST['total'];
    $pay= $_POST['pay'];
    $balance= $_POST['balance'];
    $payment_type= $_POST['pstatus'];


}

if($stmt->execute()){


    $last_id = $conn->insert_id;


}

$relation_list = $_POST['data'];


for($x=0;$x<count($relation_list);$x++)
{

    $stmt1 = $conn->prepare("insert into sales_item(sales_id,product_id,sell_price,qty,total) values (?,?,?,?,?)");
    $stmt1->bind_param("iisss",$last_id ,$product_id,$sell_price,$qty,$total);


    $product_id =$relation_list[$x]['procode'];
    $sell_price=$relation_list[$x]['price'];
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