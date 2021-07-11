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

    <h1 style="text-align: center">Registation Panel</h1>

    <div class="row">
        <div class="col-sm-4">

            <form class="form-horizontal" id="frmBrand">

                <div class="form-group" align="left">
                    <lable>User Name</lable>
                    <input type="text" id="username" class="form-control" name="username" placeholder="Name" required>
                </div>

                <div class="form-group" align="left">
                    <lable>Password</lable>
                    <input type="password" id="password" class="form-control" name="password" placeholder="password" required>
                </div>

                <div class="form-group" align="left">
                    <lable>Status</lable>
                    <select class="form-control" id="status" name="status" required>

                        <option value="">Please Select</option>
                        <option value="1">Cashier</option>
                        <option value="2">Admin</option>

                    </select>
                </div>
                <div align="right">

                    <button type="button" class="btn btn-info" id="save" onclick="AddBrand()">ADD</button>
                    <button type="button" class="btn btn-warning" id="reset" onclick="resetfeild()">Reset</button>
                </div>
            </form>

        </div>
        <div class="col-sm-8">

            <div class="panel-body">

                <table id="tbl-brand" class="table table-responsive table-bordered" cellspacing="0" width="100%">

                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>



                </table>


            </div>
        </div>

    </div>
</div>

<script>

    var Isnew = true;
    get_all();

    var brand_id = null;

    function AddBrand(){

        if($('#frmBrand').valid()) {
            var _url = '';
            var _data = '';
            var _method;


            if (Isnew == true) {

                _url = '../php/login/signup.php';
                _data = $("#frmBrand").serialize();
                _method = 'POST';
            } else {

                _url = '../php/login/update_login.php';
                _data = $("#frmBrand").serialize() + "&brand_id=" + brand_id;
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

                        msg = "Brand Created";
                        setInterval('location.reload()', 2010);
                    } else {
                        msg = "Brand Updated";
                        setInterval('location.reload()', 2010);

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

            url :"../php/login/all_login.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-brand').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    "aoColumns": [

                        {"sTitle":"Brand","mData": "username"},
                        {"sTitle":"Brand","mData": "password"},
                        {
                            "sTitle":"Status","mData": "status", "render":function (mData,type,row,meta){

                                if(mData == 1){

                                    return '<span class="label label-info">Cashier</span>';
                                }
                                else if(mData == 2){

                                    return '<span class="label label-warning">Admin</span>';

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
            url : '../php/login/edit_login.php',
            dataType: 'JSON',
            data :{brand_id:id},

            success:function (data){

                $("html,body").animate({scrollTop:0},"slow");
                Isnew =false
                brand_id =data.id
                $('#username').val(data.username);
                $('#password').val(data.password);

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
                        url :'../php/brand/remove_brand.php',
                        dataType :'JSON',
                        data:{brand_id:id},

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


    $('#username').val("");
    $('#password').val("");
    $('#status').val("");
}


</script>




</body>
</html>