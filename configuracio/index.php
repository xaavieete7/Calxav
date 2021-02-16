<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("configuracio");

    $rank = $_SESSION['rank'];

    if ($rank != 'user' && $rank != 'admin') {
        header('Location: /404.php');
        exit;
    }

    //Contract form and calendar form
    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
    $username = $_SESSION['username'];
    $args = "SELECT * FROM `info_users` WHERE `username` LIKE '$username'";
    $sql = mysqli_query($conn, $args);
    $rows = mysqli_fetch_assoc($sql);
    $priceHour = $rows['priceHour'];
    $salary_target = $rows['salary_target'];
    $max_hours = $rows['max_hours'];
    $default_hour = $rows['default_hour'];


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
	    <?php printf($obj->Sidebar("configuracio")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Configuració</h4>
                                </div>
                                <div class="card-body">

                                    <h4 class="mt-2">Contracte:<hr></h4>

                                    <form id="form_contract" class="mt-4">
                                        <div class="form-row">

                                            <input type="hidden" name="action" value="form_contract">
                                            <div class="form-group col-md-4 mb-4">
                                                <label>Preu hora:</label>
                                                <input type="number" name="priceHour" id="priceHour" value="<?php echo $priceHour; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4 mb-4">
                                                <label>Objectiu mensual:</label>
                                                <input type="number" name="salary_target" id="salary_target" value="<?php echo $salary_target; ?>" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4 mb-4">
                                                <label>Hores màximes:</label>
                                                <input type="number" name="max_hours" id="max_hours" value="<?php echo $max_hours; ?>" class="form-control">
                                            </div>

                                            <div class="form-group col-md-12 text-right">
                                                <button type="button" id="save_contract_form" class="btn btn-danger boton">Guardar</button>
                                            </div>
                                        </div>

                                    </form>

                                    <h4 class="mt-2">Calendari:<hr></h4>

                                    <form id="form_calendar" class="mt-4">
                                        <div class="form-row">

                                            <input type="hidden" name="action" value="form_calendar">
                                            <div class="form-group col-md-2 mb-4">
                                                <label>Hora predeterminada:</label>
                                                <input type="time" name="default_hour" id="default_hour" value="<?php echo $default_hour; ?>" class="form-control">
                                            </div>
                                            
                                            <div class="form-group col-md-12 text-right">
                                                <button type="button" id="save_form_calendar" class="btn btn-danger boton">Guardar</button>
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