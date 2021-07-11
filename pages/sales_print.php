<?php

include("../php/db.php");
date_default_timezone_set("Asia/Colombo");
$last_id = $_GET['last_id'];
$sql = "select i.sales_id,i.product_id,i.sell_price,i.qty,i.total,p.date,p.total,p.pay,p.balance,p.payment_type,pr.product_name,pr.warranty  from sales p ,sales_item i,product pr where p.id=i.sales_id and pr.barcode=i.product_id and i.sales_id= $last_id ";


$orderResult = $conn->query($sql);

$orderdatalist = $orderResult->fetch_array();

$sales_id= $orderdatalist[0];
$product_id = $orderdatalist[1];
$sell_price = $orderdatalist[2];
$qty = $orderdatalist[3];
$total = $orderdatalist[4];
$date = $orderdatalist[5];
$subtotal = $orderdatalist[6];
$pay = $orderdatalist[7];
$balance = $orderdatalist[8];
$payment_type =$orderdatalist[9];
$product_name =$orderdatalist[10];
$warranty =$orderdatalist[11];


?>

<html>
<head>

    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
    <link href="../components/jquery-confirm-master/css/jquery-confirm.css" rel="stylesheet">
    <link  href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >

    <style>

        @media print {

            .button{

                display: none;
            }

        }
        @media print {

            @page{

                margin-top: 0;
                margin-bottom: 0;
            }
            body{

                padding-top: 72px;
                padding-bottom: 72px;
            }

        }



    </style>





</head>
<body style="background: #f9f9f9">
<script src="../components/jquery/dist/jquery.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../components/jquery.validate.min.js"></script>

<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../components/jquery-confirm-master/js/jquery-confirm.js"> </script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>




<div class="container" style="margin-top:-90px;">

    <div class="row">

        <div class="col-xs-12">

            <div class="print" style=" width:88mm;background:white; padding:10px;margin:0 auto;text-align: center;";>

                <div align="center">

                    <h2>VEENS Super</h2>
                    <h6>Udani kamala litro gas dealer<br> rideegama</h6>
                    <h6>Tel:- 072-4492383 , 071-4433655</h6>
                    <h4>Invoice</h4><br>
              </div>



                <div align="left">

                    Date <b><?php echo $date ?></b><br>

                    Time <?php echo date("h:i:sa");?><br>

                    <?php

                        if($payment_type == 1){
                            ?>

                            Invoice Type :- Cash
                        <?php
                        }
                        else{
                            ?>
                            Invoice Type :- credit

                            <?php
                        }
                    ?>

                </div>

                </div>

                <div align="right">

                    Invoice Number :<b><?php echo $last_id ?></b>





                </div>

                </br>
                <table class="table table-responsive">

                    <thread>

                        <tr>

                            <td class="text-center"><b>No</b></td>
                            <td class="text-center"><b>Item</b></td>
                            <td class="text-center"><b>Qty</b></td>
                            <td class="text-center"><b>Price</b></td>
                            <td class="text-center"><b>Total</b></td>

                        </tr>

                    </thread>

                    <?php

                    $x=1;
                    $orderResult = $conn->query($sql);

                    while($row = $orderResult->fetch_array()){




                        ?>


                        <tr>

                            <td class="text-center"><?php echo $x ?></td>
                            <td class="text-center"><?php echo $row[10] ?></br>RS:-<?php echo  $row[11]   ?></td>
                            <td class="text-center"><?php echo $row[3] ?></td>
                            <td class="text-center"><?php echo $row[2] ?></td>
                            <td class="text-center"><?php echo $row[4] ?></td>

                        </tr>

                        <?php  $x++; } ?>




                </table>
                <hr>
                <div align="right">

                    Total :- <?php echo $subtotal ?>
                </div>
                <div align="right">

                    Pay :- <?php echo $pay?>

                </div>

                <div align="right">
                    Due:- <?php echo $balance ?>

                </div>

            <div align="center">

                <h4>---- Thank You Come again ----</h4>
                <h5>Software Developer 037225944 (Shiwantha)</h5>

            </div>


            </div>


        </div>



    </div>


</div>



<script>

    myFunction();

    function myFunction(){
        window.print();
    }

    window.onafterprint = function (e){

        closePrintView();
    }

    function closePrintView(){
        window.location.href ='sales.php';
    }


</script>




</body>

</html>
