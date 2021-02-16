<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("seguretat");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header -->
    <?php printf($obj->Head()); ?>
    <script src="index.js"></script>

</head>

<body class="">
    <div class="wrapper">
        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("seguretat")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title">Seguretat</h4>
                                </div>
                                <div class="card-body">
                                    <h4 class="mt-2">Canviar la contrasenya:<hr></h4>

                                    <form id="form" class="mt-4">
                                        <div class="form-row">

                                            <div class="form-group col-md-4 mb-4">
                                                <label>Contrasenya anterior:</label>
                                                <input type="password" name="oldPass" id="oldPass" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4 mb-4">
                                                <label>Nova contrasenya:</label>
                                                <input type="password" name="newPass" id="newPass" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4 mb-4">
                                                <label>Repeteix la nova contrasenya:</label>
                                                <input type="password" name="repetePass" id="repetePass" class="form-control">
                                            </div>

                                            <div class="form-group col-md-12 text-right">
                                                <button type="button" id="save_form" class="btn btn-danger boton">Guardar</button>
                                            </div>
                                        </div>

                                    </form>
                                <div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer src -->
    <?php printf($obj->Footerlinks()); ?>

</body>

</html>