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

<div class="container-fluid">

    <div class="row">

        <div class="col-sm-12">
            <form id="frmVendor">

                <h1 style="text-align: center">Purchase Bill </h1>
                </br>
                <div class="row">

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Bill ID</lable>
                            <input type="number" id="billid" class="form-control" name="billid" placeholder="Bill ID" disabled>
                        </div>


                    </div>

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Date</lable>
                            <input type="date" id="date" class="form-control" name="date" placeholder="Date" required>
                        </div>


                    </div>

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Pay Amount</lable>
                            <input type="number" id="payamount" class="form-control" name="payamount" placeholder="Amount" required>
                        </div>


                    </div>

                </div>

                <div align="right">

                    <button type="button" class="btn btn-info" id="save" onclick="AddVendor()">ADD</button>
                    <button type="button" class="btn btn-warning" id="reset" onclick="resetfeild()">Reset</button>
                </div>


            </form>

        </div>



    </div>


</div>




</div>


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

    function AddVendor(){

        if($('#frmVendor').valid()) {
            var _url = '';
            var _data = '';
            var _method;


            if (Isnew == true) {

            } else {

                _url = '../php/return/update_bill.php';
                _data = $("#frmVendor").serialize() + "&vendor_id=" + vendor_id;
                _method = 'POST';


            }

            $.ajax({

                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                success: function (data) {

                    var msg;


                    if (Isnew) {

                        msg = "Vendor Added";
                        window.location.reload();
                    } else {
                        msg = "Vendor Updated";
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

    function get_all(){

        $.ajax({

            url :"../php/return/all_purchase.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-vendor').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    "aoColumns": [

                        {"sTitle":"Bill Number","mData": "id"},
                        {"sTitle":"vendor id","mData": "vname"},
                        {"sTitle":"Date","mData": "date"},
                        {"sTitle":"Total","mData": "total"},
                        {"sTitle":"Pay","mData": "pay"},
                        {"sTitle":"Due","mData": "due"},

                        {
                            "sTitle":"Status","mData": "due", "render":function (mData,type,row,meta){

                                if(mData == 0){

                                    return '<span class="label label-info">Cash</span>';
                                }
                                else{

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
                            "mData":"vender_id",
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
            url : '../php/return/edit_return.php',
            dataType: 'JSON',
            data :{vendor_id:id},

            success:function (data){

                $("html,body").animate({scrollTop:0},"slow");
                Isnew =false
                vendor_id =data.id

                $('#billid').val(data.id);
                $('#due').val(data.due);




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
                            window.location.reload();

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

        $('#billid').val("");
        $('#date').val("");
        $('#payamount').val("");

    }

</script>




</body>
</html>