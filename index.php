<html>
<head>

    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="components/bootstrap/dist/css/bootstrap.css">
    <link href="components/jquery-confirm-master/css/jquery-confirm.css" rel="stylesheet">
    <link  href="http://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet" >
    <script type="text/javascript">
        function disableBack() { window.history.forward(); }
        setTimeout("disableBack()", 0);
        window.onunload = function () { null };
    </script>

</head>
<body>
<script src="components/jquery/dist/jquery.js"></script>
<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="components/jquery.validate.min.js"></script>

<script src="components/bootstrap/dist/js/bootstrap.js"></script>
<script src="components/jquery-confirm-master/js/jquery-confirm.js"> </script>
<script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<?php

include('loginHeader.php');

?>

<div class="container">

    <div class="row">
    <div class="col-sm-4">
        <h1>Login to The System</h1>

    </div>
    </div>
    <div class="col-sm-4">

        <form class="form-horizontal" id="frmlogin">

            <div class="form-group" align="left">
                <lable>User Name</lable>
                <input type="text" id="username" class="form-control" name="username" placeholder="User" required>
            </div>

            <div class="form-group" align="left">
                <lable>Password</lable>
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <div align="right">

                <button type="button" class="btn btn-info" id="save" onclick="login()">LOGIN</button>
            </div>
        </form>

    </div>


</div>




<script>


    function login(){

        if($('#frmlogin').valid()) {
            var _url = '';
            var _data = '';
            var _method;


                _url = 'php/login/login.php';
                _data = $("#frmlogin").serialize();
                _method = 'POST';


            $.ajax({

                type: _method,
                data: _data,
                url: _url,
                dataType: 'JSON',

                success: function (data) {

                    if(data == 1) {

                        $.alert({

                            title: ' Login Success ',
                            content: "Success",
                            type: 'GREEN',
                            boxWidth: '400px',
                            theme: 'light',
                            useBootstrap: false,
                            autoClose: 'ok|2000'


                        });

                        setInterval('location.reload()', 2010);
                        window.location="pages/userSale.php";

                    }
                    else if(data == 2){

                        $.alert({

                            title: ' Login Success ',
                            content: "Success",
                            type: 'GREEN',
                            boxWidth: '400px',
                            theme: 'light',
                            useBootstrap: false,
                            autoClose: 'ok|2000'


                        });

                        setInterval('location.reload()', 2010);
                        window.location="pages/product.php";



                    }
                    else{


                        $.alert({

                            title: 'Sorry',
                            content: "username or password not working",
                            type: 'RED',
                            boxWidth: '400px',
                            theme: 'light',
                            useBootstrap: false,
                            autoClose: 'ok|2000'


                        });



                    }


                },

            });




        }



    }


</script>


</body>
</html>