<?php

include("../php/db.php");

    $last_id = $_GET['last_id'];
    $sql = "select i.purchase_id,i.product_id,i.buy_price,i.qty,i.total,p.date,p.total,p.pay,p.due,pr.product_name  from purchase p ,purchase_item i,product pr where p.id=i.purchase_id and i.purchase_id= $last_id and pr.barcode=i.product_id";

    $orderResult = $conn->query($sql);


    $orderdata = $orderResult->fetch_array();
    $purchase_id = $orderdata[0];
    $product_id = $orderdata[1];
    $buy_price = $orderdata[2];
    $qty = $orderdata[3];
    $total = $orderdata[4];
    $date = $orderdata[5];
    $subtotal = $orderdata[6];
    $pay = $orderdata[7];
    $due = $orderdata[8];
    $product_name =$orderdata[9];


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
           margin-left: 0;
           margin-right: 0;
           margin-bottom: 0;
       }
       body{

           padding: 0;
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




<div class="container">

    <div class="row">

        <div class="col-xs-12">

            <div class="print" style=" width:88mm;background:white; padding:10px;margin:0 auto;text-align: center; margin-left:5px; ";>


                <div align="center">

                    <h3>Purchase Invoice</h3>





                </div>

                <div align="left">

                    Date <b><?php echo $date ?></b>



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
                        <td class="text-center"><?php echo $row[9] ?></td>
                        <td class="text-center"><?php echo $row[3] ?></td>
                        <td class="text-center"><?php echo $row[2] ?></td>
                        <td class="text-center"><?php echo $row[4] ?></td>

                    </tr>

                    <?php  $x++; } ?>




                </table>


                <div align="right">

                    Sub Total <b><?php echo $subtotal ?></b>
                </div>
                <div align="right">

                    Pay <b><?php echo $pay ?></b>
                </div>
                <div align="right">

                    Due <b><?php echo $due ?></b>
                </div>
<br>
                <div align="center">

                    Due <b><?php echo 'Shiwantha wickramage' ?></b>
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
