<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();

    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("administracio");

    $admin_level = $_SESSION['admin_level'];

    if ($admin_level == 0) {
        header('Location: /404.php');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Header -->
	<?php printf($obj->Head()); ?>
    <link href="../assets/css/admin.css" rel="stylesheet" />
    <script src="index.js"></script>

</head>

<script>

    $(document).ready( function(){
        $('#notificacion_table').load('/admin/notifiaciones.php');
    });

    function removeEvent( id ) {
        $.ajax({
            type:"POST",
            url: 'functions.php',
            data: {'id': id, 'action': "remove_notification"},
            success: function(data){

                //Display success message
                Swal.fire({
                    icon: 'swal2-icon-show',
                    title: '<i class="material-icons success-icon mr-2">check_circle_outline</i>',
                    text: data.message,
                    timer: 3000,
                    toast: true,
                    position: 'top-end',
                    showCancelButton: false,
                    showConfirmButton: false
                });
                
                $('#notificacion_table').load('/admin/notifiaciones.php');
            }
        });
    }

</script>

<body class="">

    <div class="wrapper">

        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("administracio")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Administració</h4>
                                </div>
                                <div class="card-body">

                                    <?php if ($admin_level > 0) { ?>

                                        <h4 class="mt-2">Notifiacions:<hr></h4>
                                        <form id="notifiacation_form">
                                            <input type="hidden" name="action" value="notifications">
                                            <div class="form-group mt-5">
                                                <label>Títol:</label>
                                                <input type="text" name="title" class="form-control">
                                            </div>

                                            <div class="form-row mt-1">
                                                <div class="col-md-6 mb-4">
                                                    <label>Tipo:</label>
                                                    <select name="type" class="form-control">
                                                        <option value="">---</option>
                                                        <option value="warning">Warning</option>
                                                        <option value="danger">Danger</option>
                                                        <option value="info">Info</option>
                                                        <option value="success">Success</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label>Visibilitat:</label>
                                                    <select name="visibility" class="form-control">
                                                        <option value="">---</option>
                                                        <option value="user">Users</option>
                                                        <option value="viewer">Viewers</option>
                                                        <option value="all">All</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group mt-4 mb-4">
                                                <label>Contingut:</label>
                                                <textarea class="form-control" name="content" rows="3"></textarea>
                                            </div>

                                            <div class="form-group col-md-12 text-right">
                                                <button type="button" id="save_notification_form" class="btn btn-danger boton">Guardar</button>
                                            </div>
                                        </form>
                                        <hr>
                                        <div id="notificacion_table" class="table-responsive"></div>

                                    <?php } ?>
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