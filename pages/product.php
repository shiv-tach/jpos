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
            <form id="frmProduct">

                <h1 style="text-align: center">Product </h1>
                    </br>
                    <div class="row">

                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Product Name</lable>
                                <input type="text" id="productName" class="form-control" name="productName" placeholder="Product Name" required>
                            </div>


                        </div>

                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Product Description</lable>
                                <input type="text" id="productDescription" class="form-control" name="productDescription" placeholder="Product Description" required>
                            </div>


                        </div>

                        <div class="col-sm-6 col-sm-3">
                        <div class="form-group" align="left">
                            <lable>Category</lable>
                            <select class="form-control" id="category" name="category" required>

                                <option value="">Please Select</option>

                            </select>
                        </div>
                        </div>

                        <div class="col-sm-6 col-sm-3">
                            <div class="form-group" align="left">
                                <lable>Brand</lable>
                                <select class="form-control" id="brand" name="brand" required>

                                    <option value="">Please Select</option>

                                </select>
                            </div>
                        </div>


                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Actual Price</lable>
                                <input type="text" id="warranty" class="form-control" name="warranty" placeholder="Actual Price" required>
                            </div>


                        </div>


                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Cost Price</lable>
                                <input type="text" id="costPrice" class="form-control" name="costPrice" placeholder="Cost Price" required>
                            </div>


                        </div>


                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Retail Price</lable>
                                <input type="text" id="retailPrice" class="form-control" name="retailPrice" placeholder="Retail Price" required>
                            </div>


                        </div>

                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>wholesale Price</lable>
                                <input type="text" id="reorderLevel" class="form-control" name="reorderLevel" placeholder="wholesale Price" required>
                            </div>


                        </div>

                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Barcode</lable>
                                <input type="text" id="barcode" class="form-control" name="barcode" placeholder="Barcode" required>
                            </div>


                        </div>

                        <div class="col-sm-6 col-sm-3">

                            <div class="form-group" align="left">
                                <lable>Product Date (expiry date)</lable>
                                <input type="date" id="productDate" class="form-control" name="productDate" placeholder="Product Date" required>
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

                    <button type="button" class="btn btn-info" id="save" onclick="AddProduct()">ADD</button>
                    <button type="button" class="btn btn-warning" id="reset" onclick="resetfeild()">Reset</button>
                </div>


            </form>

                </div>



        </div>


    </div>




</div>


<div class="col-sm-12">

    <div class="panel-body">

        <table id="tbl-product" class="table table-responsive table-bordered" cellspacing="0" width="100%">

            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
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


    getCategory();
    getBrand();

    function getCategory(){

        $.ajax({

           type :'GET',
           url : '../php/category/getcategory.php',
           dataType :'JSON',
           success:function (data){

               for(var i=0;i<data.length;i++){

                   $('#category').append($("<option/>",{

                       value: data[i].id,
                       text: data[i].category,

                   }));

               }

           },

            error: function (){

               

            }


        });

    }


    function getBrand(){

        $.ajax({

            type :'GET',
            url : '../php/brand/getbrand.php',
            dataType :'JSON',
            success:function (data){

                for(var i=0;i<data.length;i++){

                    $('#brand').append($("<option/>",{

                        value: data[i].id,
                        text: data[i].brand,

                    }));

                }

            },

            error: function (){

               
            }


        });

    }



    var Isnew = true;
    get_all();
    var brand_id = null;

    function AddProduct(){

        if($('#frmProduct').valid()) {
            var _url = '';
            var _data = '';
            var _method;


            if (Isnew == true) {

                _url = '../php/product/add_product.php';
                _data = $("#frmProduct").serialize();
                _method = 'POST';
            } else {

                _url = '../php/product/update_product.php';
                _data = $("#frmProduct").serialize() + "&brand_id=" + brand_id;
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

    function get_all(){

        $.ajax({

            url :"../php/product/all_product.php",
            type:"GET",
            dataType:"JSON",

            success:function (data){

                $('#tbl-product').dataTable({

                    "aaData" : data,
                    "scrollX":true,

                    "aoColumns": [

                        {"sTitle":"Product Name","mData": "product_name"},
                        {"sTitle":"Description","mData": "description"},
                        {"sTitle":"Barcode","mData": "barcode"},
                        {"sTitle":"Category","mData": "category_id"},
                        {"sTitle":"Brand","mData": "brand_id"},
                        {"sTitle":"Actual Price","mData": "warranty"},
                        {"sTitle":"Price Retail","mData": "price_retail"},
                        {"sTitle":"Price Cost","mData": "price_cost"},
                        {"sTitle":"wholesale Price","mData": "reorderlevel"},
                        {"sTitle":"Qty","mData": "qty"},
                        {"sTitle":"Date","mData": "date"},


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
                            "mData":"product_id",
                            "render" :function (mData, type, row, meta){

                                return '<button class="btn btn-xs btn-success" onclick="get_brand_details(' +mData+')">Edit</button>';
                            }
                        },
                        {
                            "sTitle":"Delete",
                            "mData":"product_id",
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
            url : '../php/product/edit_return.php',
            dataType: 'JSON',
            data :{brand_id:id},

            success:function (data){

                $("html,body").animate({scrollTop:0},"slow");
                Isnew =false;
                brand_id =data.id;
                $('#productName').val(data.product_name);
                $('#productDescription').val(data.description);
                $('#category').val(data.category_id);
                $('#brand').val(data.brand_id);
                $('#costPrice').val(data.price_cost);
                $('#retailPrice').val(data.price_retail);
                $('#warranty').val(data.warranty);
                $('#barcode').val(data.barcode);
                $('#productDate').val(data.date);
                $('#reorderLevel').val(data.reorderlevel);


                $('#status').val(data.status);




            },
            error:function (xhr,status,error){

                
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
                        url :'../php/product/remove_product.php',
                        dataType :'JSON',
                        data:{brand_id:id},

                        success: function (data)
                        {
                            window.location.reload();

                        },
                        error: function (xhr,status,error){

                            
                        }

                    });
                },

                no:function (){


                }
            }


        });

    }


    function resetfeild(){

        $('#productName').val("");
        $('#productDescription').val("");
        $('#category').val("");
        $('#brand').val("");
        $('#costPrice').val("");
        $('#retailPrice').val("");
        $('#warranty').val("");
        $('#barcode').val("");
        $('#productDate').val("");
        $('#reorderLevel').val("");


        $('#status').val("");

    }

</script>






</body>
</html>