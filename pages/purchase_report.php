<html>
<head>

    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../components/bootstrap/dist/css/bootstrap.css">
    <link href="../components/jquery-confirm-master/css/jquery-confirm.css" rel="stylesheet">
    <link  href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >

</head>
<body>
<script src="../components/jquery/dist/jquery.js"></script>
<script src="../components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../components/jquery.validate.min.js"></script>

<script src="../components/bootstrap/dist/js/bootstrap.js"></script>
<script src="../components/jquery-confirm-master/js/jquery-confirm.js"> </script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<?php

include('../header.php');

?>

<h1 style="text-align: center">Purchase Report</h1>

<div class="col-sm-12">

    <div class="panel-body">

        <table id="tbl-vendor" class="table table-responsive table-bordered" cellspacing="0" width="100%">

            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>


            </tr>



        </table>


    </div>
</div>











<script>

    var Isnew = true;
    get_all();
    var vendor_id = null;


    function get_all(){



        Isnew =false;

        $.ajax({

            url :"../php/report/all_purchase.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-vendor').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    dom: 'lBfrtip',
                    buttons: [
                        'excel', 'csv', 'pdf', 'copy'
                    ],
                    "aoColumns": [

                        {"sTitle":"Vendor ID","mData": "vid"},
                        {"sTitle":"Vendor Name","mData": "date"},
                        {"sTitle":"Date","mData": "vendor_id"},
                        {"sTitle":"Total","mData": "total"},
                        {"sTitle":"Paid","mData": "pay"},
                        {"sTitle":"Credit","mData": "due"},

                        {
                            "sTitle":"Payment Type","mData": "due", "render":function (mData,type,row,meta){

                                if(mData == 0){

                                    return '<span class="label label-info">Cash</span>';
                                }
                                else {

                                    return '<span class="label label-warning">Credit</span>';

                                }
                            }
                        },




                        {
                            "sTitle":"Edit",
                            "mData":"id",
                            "render" :function (mData, type, row, meta){

                                return '<button class="btn btn-xs btn-success" onclick="get_brand_details(' +mData+')">Edit</button>';
                            }
                        },
                        {
                            "sTitle":"Delete",
                            "mData":"id",
                            "render": function (mData, type, row, meta){

                                return '<button class="btn btn-xs btn-primary" onclick ="RemoveBrand(' + mData+')">Delete</button>';
                            }
                        }

                    ]



                });

            },




        });

    }

    function get_brand_details(id){

        $.ajax({

            type:'POST',
            url : '../php/vendor/edit_return.php',
            dataType: 'JSON',
            data :{vendor_id:id},

            success:function (data){

                $("html,body").animate({scrollTop:0},"slow");
                Isnew =false
                vendor_id =data.vender_id
                $('#vendorname').val(data.vendorname);
                $('#contactno').val(data.contactno);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#status').val(data.status);




            },
            error:function (xhr,status,error){

                alert(xhr.responseText);
            }
        });


    }

    function RemoveBrand(id){

        $.confirm({
            theme :'supervan',
            buttons:{

                yes:function (){

                    $.ajax({

                        type:'POST',
                        url :'../php/vendor/remove_vendor.php',
                        dataType :'JSON',
                        data:{vendor_id:id},

                        success: function (data)
                        {


                        },
                        error: function (xhr,status,error){

                            alert(xhr.responseText);
                        }

                    });
                },

                no:function (){


                }
            }


        });

    }


    function resetfeild(){

        $('#vendorname').val("");
        $('#contactno').val("");
        $('#email').val("");
        $('#address').val("");
        $('#status').val("");
    }




    function VendorPayment() {


        if($('#frmVendor').valid()) {
            var _url = '';
            var _data = '';
            var _method;


            if (Isnew == true) {

                _url = '../php/vendor/make_payment.php';
                _data = $("#frmVendor").serialize();
                _method = 'POST';
            } //else {

              //  _url = '../php/product/';
             //   _data = $("#frmProduct").serialize() + "&brand_id=" + brand_id;
             //   _method = 'POST';


            //}

            $.ajax({

                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                success: function (data) {

                    var msg;


                    if (Isnew) {

                        msg = "Product Created";
                        window.location.reload();
                    } else {
                        msg = "Product Updated";
                        window.location.reload();


                    }

                    $.alert({

                        title: 'Success!',
                        content: msg,
                        type: 'GREEN',
                        boxWidth: '400px',
                        theme: 'light',
                        useBootstrap: false,
                        autoClose: 'ok|2000'


                    });


                },

            });

        }




    }


</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"> </script>




</body>
</html>