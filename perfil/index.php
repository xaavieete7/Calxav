<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("perfil");

    //Public info profile
    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
    $username = $_SESSION['username'];
    $args = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
    $sql = mysqli_query($conn, $args);
    $rows = mysqli_fetch_assoc($sql);
    $firstname = $rows['firstname'];
    $lastname = $rows['lastname'];
    $email = $rows['email'];
    $data_neixament = $rows['data_neixament'];
    $empresa = $rows['empresa'];
    $ciutat = $rows['ciutat'];
    $color_preferit = $rows['color_preferit'];
    $carrec = $rows['carrec'];
    $is_public = $rows['is_public'];

    switch($carrec) {
        case "Chief Executive Officer (CEO)":
            $ceo_selected = "selected=selected";
            break;
        case "Chief Technology Officer (CTO)":
            $cto_selected = "selected=selected";
            break;
        case "Junior Developer":
            $junior_selected = "selected=selected";
            break;
        case "Sysadmin":
            $sysadmin_selected = "selected=selected";
            break;
    }
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
	    <?php printf($obj->Sidebar("perfil")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Edita el perfil</h4>
                                    <p class="card-category">Completa el teu perfil</p>
                                </div>
                                <div class="card-body">
                                    <h4 class="mt-2">Informació pública:<hr></h4>

                                    <form id="form" class="mt-4">
                                        <div class="form-row">

                                            <input type="hidden" name="action" value="public_info">
                                            <div class="form-group col-md-6 mb-4">
                                                <label>Nom:<i class="required">*</i></label>
                                                <input type="text" name="firstname" id="firstname" value="<?php echo $firstname; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 mb-4">
                                                <label>Cognoms:</label>
                                                <input type="text" name="lastname" id="lastname" value="<?php echo $lastname; ?>" class="form-control">
                                            </div>
                                        
                                        </div>
                                        <div class="form-row">

                                            <div class="form-group col-md-6 mb-4">
                                                <label>Email:</label>
                                                <input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 mb-4">
                                                <label>Data de neixament:</label>
                                                <input type="date" name="data_neixament" id="data_neixament" value="<?php echo $data_neixament; ?>" class="form-control">
                                            </div>

                                        </div>

                                        <div class="form-row">
                                        
                                            <div class="form-group col-md-6 mb-4">
                                                <label>Empresa:</label>
                                                <input type="text" name="company" id="company" value="<?php echo $empresa; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 mb-4 bmd-form-group is-filled">
                                                <label class="bmd-label-static">Càrrec:</label>
                                                <select name="carrec" class="form-control">
                                                    <option value="Chief Executive Officer (CEO)" <?php echo $ceo_selected; ?>>CEO</option>
                                                    <option value="Chief Technology Officer (CTO)" <?php echo $cto_selected; ?>>CTO</option>
                                                    <option value="Junior Developer" <?php echo $junior_selected; ?>>Junior Developer</option>
                                                    <option value="Sysadmin" <?php echo $sysadmin_selected; ?>>Sysadmin</option>
                                                </select>
                                            </div>
                                            
                                        </div>

                                        <div class="form-row">
                                        
                                            <div class="form-group col-md-6 mb-4 mb-4">
                                                <label>Ciutat:</label>
                                                <input type="text" name="city" id="city" value="<?php echo $ciutat; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-6 mb-4">
                                                <label>Color preferit:</label>
                                                <input type="color" name="color" id="color" value="<?php echo $color_preferit; ?>" class="form-control">
                                            </div>

                                        </div>

                                        <div class="form-row">

                                            <?php if ($is_public == "true") {
                                                $is_public_checked = 'checked="checked"';
                                            }?>

                                            <div class="form-group col-md-12">
                                                <input type="checkbox" name="is_public" <?php echo $is_public_checked; ?> id="is_public" value="true">
                                                <label for="is_public">Perfil públic (La informació del perfil serà publica per a tots els usuaris)</label>
                                            </div>
                                        
                                            <div class="form-group col-md-12">
                                                <input type="checkbox" name="terms" id="terms" value="terms">
                                                <label for="terms">Accepto els <a href="terminos-y-condiciones.php" class="text-danger">termes i condicions</a></label>
                                            </div>

                                        </div>

                                        <div class="form-group col-md-12 text-right">
                                            <button type="button" id="save_form" class="btn btn-danger boton">Guardar</button>
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