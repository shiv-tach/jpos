<html>
<head>

    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
    <link href="../components/jquery-confirm-master/css/jquery-confirm.css" rel="stylesheet">
    <link  href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >
    <script type="text/javascript">
        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };
    </script>


</head>
<body>
<script src="../components/jquery/dist/jquery.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../components/jquery.validate.min.js"></script>

<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../components/jquery-confirm-master/js/jquery-confirm.js"> </script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<?php

include('../loginInheader.php');

?>

<div class="container-fluid">

    <div class="row">
        <div class="col-sm-8">

            <form class="form-horizontal" id="frmPurchase">






                    <div class="form-group" align="left">



                <form id="frmProduct">
                    <table class="table table-bordered" id="frmProduct">

                        <caption>Add Product</caption>

                        <tr>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Amount</th>
                            <th>Option</th>


                        </tr>
                        <tr>
                            <td>

                                <input type="text" id="procode" class="form-control" name="procode" placeholder="procode" required>

                            </td>
                            <td>

                                <input type="text" id="proname" class="form-control" name="proname" placeholder="proname" disabled>

                            </td>
                            <td>

                                <input type="text" id="price" class="form-control" name="price" placeholder="price" disabled>

                            </td>
                            <td>

                                <input type="number" id="qty" class="form-control" name="qty" placeholder="qty" min="1" value="1" required>

                            </td>

                            <td>

                                <input type="text" id="tot_cost" class="form-control" name="tot_cost" placeholder="total cost" disabled>

                            </td>

                            <td>

                                <button class="btn btn-success" type="button" onclick="add_product()">Add</button>

                            </td>


                        </tr>

                    </table>
                </form>


                <table class="table table-bordered" id="productlist">
                    <thead>
                    <tr>

                        <th>Remove</th>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Amount</th>

                    </tr>

                    </thead>


                    <tbody>

                    </tbody>



                </table>


        </div>



    </div>
    <div class="col-sm-4">

        <div class="form-group" align="left">
            <lable>Total</lable>
            <input type="text" id="total" class="form-control" name="total" placeholder="total" disabled>
        </div>

        <div class="form-group" align="left">
            <lable>Pay</lable>
            <input type="text" id="pay" class="form-control" name="pay" placeholder="pay" required>
        </div>

        <div class="form-group" align="left">
            <lable>Balance</lable>
            <input type="text" id="balance" class="form-control" name="balance" placeholder="Balance" disabled>
        </div>

        <div class="form-group" align="left">
            <lable>Payment Status</lable>
            <select class="form-control" id="pstatus" name="pstatus" required>

                <option value="">Please Select</option>
                <option value="1">Cash</option>
                <option value="2">Credit</option>

            </select>
        </div>

        <div align="right">

            <button type="button" class="btn btn-info" id="save" onclick="AddInvoice()">ADD</button>
            <button type="button" class="btn btn-warning" id="reset" onclick="">Reset</button>
        </div>


    </div>

</div>
</div>

<script>

    getProductcode();

    var isNew = true;
    var current_stock=0;
    var productid;

    function getProductcode(){

        $("#procode").keyup(function (e){

            $.ajax({

                type: "POST",
                url:'../php/product/get_product.php',
                dataType:"JSON",
                data:{procode:$("#procode").val()},


                success:function(data){

                    $("#proname").val(data[0].product_name);
                    $("#price").val(data[0].price_retail);
                    $("#qty").focus();
                    current_stock= Number(data[0].qty);
                    productid=data[0].product_id;

                },
                error:function(){


                }

            });
        });

    }



    $(function (){


        $("#price,#qty").on("keydown keyup click",qty);

        function qty(){


            var sum = (Number($("#price").val()) * Number($("#qty").val()) );


            $("#tot_cost").val(sum);


        }




    });



    function add_product(){

        var product = {

            procode :$("#procode").val(),
            proname :$("#proname").val(),
            price :$("#price").val(),
            qty :$("#qty").val(),
            tot_cost :$("#tot_cost").val()


        };

        addRow(product);
        $("#procode").val("");
        $("#proname").val("");
        $("#price").val("");
        $("#qty").val("1");
        $("#tot_cost").val("");

    }


    var total = 0;

    function addRow(product) {


        var qty = $("#qty").val();


        if ($('#procode').val().length == 0) {


            $.alert({


                title: 'Error',
                content: 'Please Enter the Product code',
                type: 'red',
                autoclose: 'ok|2000'

            });


        } else if (current_stock < qty) {


            $.alert({


                title: 'Error',
                content: 'Stock is not enough!! current Stock :- '+current_stock,
                type: 'red',
                autoclose: 'ok|2000'

            });


        } else {


            $.ajax({

                type: "POST",
                url:'../php/product/qty_de.php',
                dataType:"JSON",
                data:{qty:$("#qty").val(),procode :$("#procode").val()},

                success:function(data){



                },
                error:function(){


                }

            });


            var $tableB = $("#productlist tbody");
            var $row = $(
                "<tr>" +

                "<td> <button type='button' name='record' class='btn btn-warning btn-xs'  onclick='deleterow(this)'>Delete</button>     </td>" +

                "<td>" + product.procode + "</td>" +
                "<td>" + product.proname + "</td>" +
                "<td>" + product.price + "</td>" +
                "<td>" + product.qty + "</td>" +
                "<td>" + product.tot_cost + "</td>" +


                "</tr>"
            );


            $row.data("procode", product.procode);
            $row.data("proname", product.proname);
            $row.data("price", product.price);
            $row.data("qty", product.qty);
            $row.data("tot_cost", product.tot_cost);

            $tableB.append($row);

            total += Number(product.tot_cost);
            $("#total").val(total);

        }
    }



    var product_total_cost;
    function deleterow(e){


        $.ajax({

            type: "POST",
            url:'../php/product/qty_in.php',
            dataType:"JSON",
            data:{

                qty: parseInt($(e).parent().parent().find('td:nth-child(5)').text(),10),
                procode: parseInt($(e).parent().parent().find('td:nth-child(2)').text(),10)




            },

            success:function(data){

                console.log(data);

            },
            error:function(){


            }

        });









        product_total_cost = parseInt($(e).parent().parent().find('td:last').text(),10);
        total-= product_total_cost;
        $("#total").val(total);

        $(e).parent().parent().remove();
    }


    $(function (){


        $("#total,#pay").on("keydown keyup ",total);

        function total(){


            var sum = (Number($("#pay").val()) - Number($("#total").val()) );


            $("#balance").val(sum);


        }




    });



    function AddInvoice(){

        var table_data = [];

        $('#productlist tbody tr').each(function (row,tr)
        {


            var sub = {

                'procode':$(tr).find('td:eq(1)').text(),
                'proname':$(tr).find('td:eq(2)').text(),
                'price':$(tr).find('td:eq(3)').text(),
                'qty':$(tr).find('td:eq(4)').text(),
                'tot_cost':$(tr).find('td:eq(5)').text(),

            };

            table_data.push(sub);

        });

        var type ='user';


        $.ajax({


            type :"POST",
            url :'../php/product/add_sales.php',
            dataType :'JSON' ,
            data: {total:$('#total').val(),procode:productid,pay:$('#pay').val(),balance:$('#balance').val(),pstatus:$('#pstatus').val(),data:table_data},


            success :function (data){



                var msg;

                if(isNew){

                    msg ="Purchase Completed";
                }

                $.alert({


                    title: 'Success',
                    content: msg,
                    type: 'green',
                    autoclose: 'ok|2000'

                });


                last_id =data.last_id;


                window.location="cus_sales_print.php?last_id=" + last_id;




            },

            error: function (xhr,status,error){

                alert(xhr);
                console.log(xhr.responseText);
            }



        });






    }









</script>




</body>
</html>