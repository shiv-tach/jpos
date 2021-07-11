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

                <h1 style="text-align: center">Vendor </h1>
                </br>
                <div class="row">

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Vendor Name</lable>
                            <input type="text" id="vendorname" class="form-control" name="vendorname" placeholder="Vendor Name" required>
                        </div>


                    </div>

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Contact Number</lable>
                            <input type="text" id="contactno" class="form-control" name="contactno" placeholder="Contact Number" required>
                        </div>


                    </div>

                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Email</lable>
                            <input type="text" id="email" class="form-control" name="email" placeholder="Email" required>
                        </div>


                    </div>


                    <div class="col-sm-6 col-sm-3">

                        <div class="form-group" align="left">
                            <lable>Address</lable>
                            <input type="text" id="address" class="form-control" name="address" placeholder="Address" required>
                        </div>


                    </div>


                    <div class="col-sm-6 col-sm-3">
                        <div class="form-group" align="left">
                            <lable>Status</lable>
                            <select class="form-control" id="status" name="status" required>

                                <option value="">Please Select</option>
                                <option value="1">Active</option>
                                <option value="2">DeActive</option>

                            </select>
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

                _url = '../php/vendor/add_vendor.php';
                _data = $("#frmVendor").serialize();
                _method = 'POST';
            } else {

                _url = '../php/vendor/update_vendor.php';
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

            url :"../php/vendor/all_vendor.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-vendor').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    "aoColumns": [

                        {"sTitle":"Vendor Name","mData": "vname"},
                        {"sTitle":"Contact","mData": "contactno"},
                        {"sTitle":"Email","mData": "email"},
                        {"sTitle":"Address","mData": "address"},

                        {
                            "sTitle":"Status","mData": "status", "render":function (mData,type,row,meta){

                                if(mData == 1){

                                    return '<span class="label label-info">Active</span>';
                                }
                                else if(mData == 2){

                                    return '<span class="label label-warning">Deactive</span>';

                                }
                            }
                        },
                        {
                            "sTitle":"Edit",
                            "mData":"vender_id",
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

        $('#vendorname').val("");
        $('#contactno').val("");
        $('#email').val("");
        $('#address').val("");
        $('#status').val("");
    }

</script>




</body>
</html>