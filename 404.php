<?php session_start(); ?>
<?php require_once('static.php'); 
    $obj = new NavBar();

    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("dashboard");
?>

<head>

    <!-- Header -->
    <?php printf($obj->Head()); ?>

    <!-- Footer links -->
    <?php printf($obj->Footerlinks()); ?>

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script> -->

    <link rel="icon" type="image/png" href="/favicon.png">

</head>

<style>

    .page_404{ 
        padding:40px 0; 
        background:#fff;
    }

    .page_404  img { 
        width:100%;
    }

    .four_zero_four_bg{
        background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
        height: 400px;
        background-position: center;
    }
    
    .four_zero_four_bg h1{
        font-size:80px;

    }
    
    .four_zero_four_bg h3{
        font-size:80px;
        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,"Noto Sans",sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    }
                
    .link_404{			 
        margin: 20px 0;
        display: inline-block;
    }

    .contant_box_404{ 
        margin-top:-50px;
    }

</style>

<body>
    <div class="wrapper">

        <!-- Sidebar -->
        <?php printf($obj->Sidebar("")); ?>

        <div class="main-panel page_404">

            <!-- Navbar -->
            <?php printf($obj->Navbar()); ?>

            <div class="container">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <div class="col-sm-12 col-sm-offset-1 text-center">

                                <div class="four_zero_four_bg">
                                    <h1 class="text-center ">404</h1>
                                </div>
                    
                                <div class="contant_box_404">
                                    <h3 class="h2">Access Denied</h3>
                                    <p>Sembla que no tens suficients permisos per accedir-hi</p>
                                    <a href="/dashboard" class="btn btn-danger boton link_404">Tornar al inici</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>