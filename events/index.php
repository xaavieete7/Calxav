<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("events");

    $rank = $_SESSION['rank'];

    if ($rank == 'viewer') {
        header('Location: /404.php');
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header -->
	<?php printf($obj->Head()); ?>
    <link href="../assets/css/events.css" rel="stylesheet" />
    <script src="index.js"></script>

</head>
<script>

    $(document).ready( function(){
        $('#event_table').load('/events/eventos.php');
    });

    function removeEvent( id ) {
        $.ajax({
            type:"POST",
            url: 'remove.php',
            data: {'id': id},
            success: function(data){
                $('#event_table').load('/events/eventos.php');
            }
        });
    }

</script>


<body class="">

    <div class="wrapper">
        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("events")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Events</h4>
                                </div>
                                <div class="card-body">
                                    <form id="event_form">
                                        <input type="hidden" name="txtType" class="form-control" id="txtType" value="event">
                                        <div class="form-row mt-1">
                                            <div class="col-md-4 mb-4">
                                                <label>Títol:<i class="required">*</i></label>
                                                <input type="text" name="title" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <label>Data inici:<i class="required">*</i></label>
                                                <input type="datetime-local" name="start" class="form-control" value="<?php echo date('Y-m-d\T00:00'); ?>">
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                <label>Color:<i class="required">*</i></label>
                                                <select name="select-color" id="select-color" class="form-control">
                                                    <option value="starupgrind">Startup Grind</option>
                                                    <option value="aniversari">Aniversari</option>
                                                    <option value="altres">Altres</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 mb-4">
                                                <label>Preview color:</label>
                                                <input type="color" name="color" id="color" class="form-control" value="#9771d1">
                                            </div>
                                        </div>

                                        <div class="form-group mt-3 mb-4">
                                            <label>Descripció:</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>

                                        <div class="form-group col-md-12 text-right">
                                                <button type="button" id="save_form" class="btn btn-danger boton">Guardar</button>
                                        </div>

                                    </form>
                                    <hr>

                                    <div id="event_table" class="table-responsive"></div>
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