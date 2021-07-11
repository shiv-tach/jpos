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
        <div class="col-sm-4">

            <form class="form-horizontal" id="frmCategory">

                <div class="form-group" align="left">
                        <lable>Category</lable>
                        <input type="text" id="catname" class="form-control" name="catname" placeholder="Category" required>
                </div>

                <div class="form-group" align="left">
                    <lable>Status</lable>
                    <select class="form-control" id="status" name="status" required>

                        <option value="">Please Select</option>
                        <option value="1">Active</option>
                        <option value="2">DeActive</option>

                    </select>
                </div>
                <div align="right">

                    <button type="button" class="btn btn-info" id="save" onclick="AddCategory()">ADD</button>
                    <button type="button" class="btn btn-warning" id="reset" onclick="resetfeild()">Reset</button>
                </div>
            </form>

        </div>
        <div class="col-sm-8">

            <div class="panel-body">

                <table id="tbl-category" class="table table-responsive table-bordered" cellspacing="0" width="100%">

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

    var category_id = null;

    function AddCategory(){

        if($('#frmCategory').valid()) {
            var _url = '';
            var _data = '';
            var _method;


            if (Isnew == true) {

                _url = '../php/category/add_category.php';
                _data = $("#frmCategory").serialize();
                _method = 'POST';
            } else {

                _url = '../php/category/update.php';
                _data = $("#frmCategory").serialize() + "&category_id=" + category_id;
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

                        msg = "Category Created";
                        window.location.reload();
                    } else {
                        msg = "Category Updated";
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

           url :"../php/category/all_category.php",
           type:"GET",
           dataType:"JSON",

            success:function (data){

               $('#tbl-category').dataTable({

                   "aaData" : data,
                   "scrollX":true,
                   "aoColumns": [

                       {"sTitle":"Category","mData": "catname"},
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

                               return '<button class="btn btn-xs btn-success" onclick="get_category_details(' +mData+')">Edit</button>';
                           }
                       },
                       {
                           "sTitle":"Delete",
                           "mData":"id",
                           "render": function (mData, type, row, meta){

                               return '<button class="btn btn-xs btn-primary" onclick ="RemoveCategory(' + mData+')">Delete</button>';
                           }
                       }

                   ]



               });

            },




        });

    }

    function get_category_details(id){

        $.ajax({

           type:'POST',
           url : '../php/category/edit_return.php',
            dataType: 'JSON',
            data :{category_id:id},

            success:function (data){

               $("html,body").animate({scrollTop:0},"slow");
                Isnew =false
                category_id =data.id
                $('#catname').val(data.catname);

                $('#status').val(data.status);




            },
            error:function (xhr,status,error){

               alert(xhr.responseText);
            }
        });


    }

function RemoveCategory(id){

        $.confirm({
           theme :'supervan',
           buttons:{

               yes:function (){

                  $.ajax({

                     type:'POST',
                     url :'../php/category/remove_category.php',
                     dataType :'JSON',
                     data:{category_id:id},

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

    $('#catname').val("");

    $('#status').val("");
}


</script>






</body>
</html>