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

                <h1 style="text-align: center">Expire Date </h1>
                </br>

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

            url :"../php/expireDate/all_expireDate.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-vendor').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    "aoColumns": [

                        {"sTitle":"Expire Date","mData": "pname"},
                        {"sTitle":"barcode","mData": "barcode"},
                        {"sTitle":"retail","mData": "qty"},

                        {
                            "sTitle":"Date To Expired","mData": "date", "render":function (mData,type,row,meta){

                                if(mData <0 ){

                                    return '<span class="label label label-success">No</span>';
                                }
                                else{

                                    return '<span class="label label label-primary">'+mData+'</span>';

                                }

                            }
                        },

                        {
                            "sTitle":"Status","mData": "date", "render":function (mData,type,row,meta){

                                if(mData <0 ){

                                    return '<span class="label  label-success">No</span>';
                                }
                                else if(mData <=7 ){

                                    return '<span class="label label-danger">Expired Soon</span>';
                                }
                                else if(mData > 7){

                                    return '<span class="label label-warning">Not Expired</span>';

                                }
                            }
                        },


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
