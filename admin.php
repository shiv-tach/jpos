<html>
<head>

    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.css">
    <link href="components/jquery-confirm-master/css/jquery-confirm.css" rel="stylesheet">
    <link  href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >

</head>
<body>
<script src="components/jquery/dist/jquery.js"></script>
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="components/jquery.validate.min.js"></script>

<script src="components/bootstrap/dist/js/bootstrap.js"></script>
<script src="components/jquery-confirm-master/js/jquery-confirm.js"> </script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<?php

include('inheader.php');

?>


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

                _url = '../php/brand/add_brand.php';
                _data = $("#frmBrand").serialize();
                _method = 'POST';
            } else {

                _url = '../php/brand/update_brand.php';
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
                    } else {
                        msg = "Brand Updated";

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

        window.location.reload();

    }

    function get_all(){

        $.ajax({

            url :"../php/brand/all_brand.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-brand').dataTable({

                    "aaData" : data,
                    "scrollX":true,
                    "aoColumns": [

                        {"sTitle":"Brand","mData": "brand"},
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
            url : '../php/brand/edit_return.php',
            dataType: 'JSON',
            data :{brand_id:id},

            success:function (data){

                $("html,body").animate({scrollTop:0},"slow");
                Isnew =false
                brand_id =data.id
                $('#brandname').val(data.brand);

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

</script>




</body>
</html>