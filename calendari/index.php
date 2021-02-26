<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objDB = new DatabaseConn();
    $objDB = new DatabaseConn();
    $objSecurity->Logintime("calendari");

    $rank = $_SESSION['rank'];

    //Get the name of the calendar to show only for viewers
    if ($rank == 'viewer') {

        if ($_GET['cal']) {
            $cal = $_GET['cal'];
            $_SESSION['cal'] = $cal;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header -->
	<?php printf($obj->Head()); ?>

    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="../assets/css/calendari.css">
    
    <script src="js/jquery.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.min.js"></script>
    <script src="js/es.js"></script>

    <!-- Footer src -->
    <?php printf($obj->Footerlinks()); ?>
    
</head>

<script>
    $(document).ready( function(){
        $('#info_table').load('/calendari/table.php');
    });
</script>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("calendari")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-9 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Calendari <?php echo ucfirst($cal); ?></h4>
                                </div>
                                <div class="card-body">

                                    <?php if ($rank != 'viewer') { ?>
                                        <div class="row justify-center">
                                            <div id="CalendarioWeb" class="col-md-10 col-sm-12 mt-2"></div>
                                            <div id="info_table" class="table-responsive col-md-10 col-sm-12 text-center mt-3"></div>
                                        </div>

                                        <div class="row justify-center">
                                            <div class="text-right col-md-10 col-sm-12">
                                                <a href="/estadistiques" class="text-danger">Veure la taula completa</a>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        
                                        <?php if ($_GET['cal']) { ?>

                                            <div class="row justify-center">
                                                <div id="CalendarioWeb" class="col-md-10 col-sm-12 mt-2"></div>
                                                <div id="info_table" class="table-responsive col-md-10 col-sm-12 text-center mt-3"></div>
                                            </div>

                                        <?php } else {

                                            $conn = $objDB->Connection();

                                            $mes = date("n");
                                            $any = date("o");

                                            $args = "SELECT * FROM `info_users`";
                                            $sql = mysqli_query($conn, $args);

                                            $html = '<div class="row justify-center">';

                                                while ($rows = mysqli_fetch_assoc($sql)) {

                                                    //Hores aquest mes
                                                    $table = $rows['table'];
                                                    $username = $rows['username'];
                                                    $args = "SELECT SUM(`horas`) FROM `$table` WHERE MONTH(`start`) = '$mes' AND YEAR(`start`) = '$any'";
                                                    $sql_html = mysqli_query($conn, $args);

                                                    while ($rows_html = mysqli_fetch_assoc($sql_html)) {

                                                        $hores_mes = $rows_html['SUM(`horas`)'];
                                                        if (empty($hores_mes)){
                                                            $hores_mes = 0;
                                                        }

                                                        $html .= '<div class="col-lg-4 col-md-6 col-sm-6">';
                                                            $html .= '<div class="card card-stats">';
                                                                $html .= '<div class="card-header card-header-danger card-header-icon">';
                                                                    $html .= '<div class="card-icon">';
                                                                        $html .= '<i class="material-icons">person</i>';
                                                                    $html .= '</div>';
                                                                    $html .= '<p class="card-category">'.ucfirst($username).'</p>';
                                                                    $html .= '<h2 class="card-title">'.$hores_mes.'';
                                                                        $html .= '<small>h</small>';
                                                                    $html .= '</h2>';
                                                                $html .= '</div>';
                                                                $html .= '<div class="card-footer">';
                                                                    $html .= '<div class="stats"><a href="/calendari?cal='.$username.'" class="text-danger">Veure calendari</a></div>';
                                                                $html .= '</div>';
                                                            $html .= '</div>';
                                                        $html .= '</div>';

                                                    }
                                                    

                                                }

                                            $html .= '</div>';
                                            print($html);

                                            ?>

                                        <?php } ?>

                                    <?php } ?>
                                <div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal(-------------------------------------------------------) -->
    <div class="modal fade" id="ModalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento">Part d'hores</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-none">

                        <input type="text" id="txtID" name="txtID"><br>
                        <input type="text" name="txtFecha" id="txtFecha"><br>

                    </div>
                    <div class="form-row mt-2">
                        <input type="hidden" name="txtType" class="form-control" id="txtType">

                        <?php 

                            if ($_SESSION['rank'] != 'viewer') {

                                $username = $_SESSION['username'];
                                $conn = $objDB->Connection();
                                $args = "SELECT * FROM `info_users` WHERE `username` LIKE '$username'";

                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $priceHour = $rows['priceHour'];
                                $default_hour = $rows['default_hour'];

                            }
                            
                        ?>
                        <input type="hidden" name="priceHour" id="priceHour" value="<?php echo $priceHour;?>">
                        <div class="form-group col-md-8 mb-4 bmd-form-group is-filled">
                            <label class="bmd-label-static">Títol:</label>
                            <select name="titulo" id="txtTitulo" class="form-control">
                                <option value="Part d'hores" selected="selected">Part d'hores</option>
                                <option value="Remot">Remot</option>
                                <option value="Festa">Festa</option>
                                <option value="Startup Grind">Startup Grind</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 mb-4">
                            <label>Hora d'entrada:</label>
                            <input type="time" min="07:00" max="19:00" step="600" name="txtHora" class="form-control"
                                id="txtHora" value="09:00">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <label>Hores treballades:</label>
                            <input type="text" name="txtHoras" class="form-control" id="txtHoras">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <label>Color:</label>
                            <input type="color" name="txtColor" class="form-control" id="txtColor" value="#FDA04E">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnAgregar" class="btn btn-success">Afegir</button>
                    <button type="button" id="btnModificar" class="btn btn-warning">Modificar</button>
                    <button type="button" id="btnBorrar" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ModalEventos(----------------------------------------------------------->
    <div class="modal fade" id="ModalEventosImportantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloEvento">Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row mt-2">
                        <input type="hidden" name="txtType" class="form-control" id="txtType">
                        <div class="form-group col-md-8 mb-4">
                            <label>Títol:</label>
                            <input type="text" name="txtTitulo" class="form-control disable-disabled" id="txtTituloImportant">
                        </div>
                        <div class="form-group col-md-4 mb-4">
                            <label>Color:</label>
                            <input type="color" name="txtColor" class="form-control disable-disabled" id="txtColorImportant" value="#FDA04E">
                        </div>
                        <div class="form-group col-md-12 mb-4">
                            <label>Descripció:</label>
                            <textarea class="form-control disable-disabled" name="txtDescription" id="txtDescriptionImportant" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(document).ready(function($) {

            $('#CalendarioWeb').fullCalendar('refetchEvents');

            $('#CalendarioWeb').fullCalendar({

                header: {
                    left: 'today,prev,next',
                    center: 'title',
                    right: 'MibotonTotal'
                },

                customButtons: {

                    //Pending to change
                    MibotonTotal: {
                        text: "Hores totals",
                        click: function() {
                            <?php
                            $conn = $objDB->Connection();
                            $table = $_SESSION['table'];
                            $args = "SELECT SUM(horas) FROM `$table`";
                            $sql = mysqli_query($conn, $args);
                            $rows = mysqli_fetch_assoc($sql);
                            $horas_totals = $rows['SUM(horas)'];
                            ?>
                            //Display success message
                            Swal.fire({
                                icon: 'swal2-icon-show',
                                title: 'Kreatings',
                                text: 'Hores treballades: <?php echo $horas_totals;?>',
                                position: 'top',
                                showCancelButton: false,
                                showConfirmButton: false,
                                showCloseButton: true
                            });
                        }
                    }

                },

                dayClick: function(date, jsEvent, view) {

                    var rank = '<?php echo $_SESSION['rank']; ?>';
                    
                    limpiarFormulario();

                    $('#btnAgregar').prop("disabled",false);
                    $('#btnBorrar').prop("disabled",true);
                    $('#btnModificar').prop("disabled",true);

                    $('#txtFecha').val(date.format());

                    if (rank == 'user' || rank == 'admin') {
                        $("#ModalEventos").modal();
                        CustomColorChange();
                    } else {
                        Swal.fire({
                            icon: 'swal2-icon-show',
                            title: '<i class="material-icons error-icon mr-2">error_outline</i>Oops...',
                            text: 'Sembla que no tens suficients permisos',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                    }

                },

                eventClick: function(calEvent, jsEvent, view) {

                    var rank = '<?php echo $_SESSION['rank']; ?>';

                    if (calEvent.type == "timesheet") {

                        $('#txtID').val(calEvent.id);
                        $('#txtTitulo').val(calEvent.title);
                        $('#txtHoras').val(calEvent.horas);
                        $('#txtColor').val(calEvent.color);
                        $('#priceHour').val(calEvent.priceHour);
                        $('#txtType').val(calEvent.type);

                        FechaHora = calEvent.start._i.split(" ");

                        $('#txtFecha').val(FechaHora[0]);
                        $('#txtHora').val(FechaHora[1]);

                        if (rank == 'user' || rank == 'admin') {
                            $('#btnAgregar').prop("disabled",true);
                            $('#btnBorrar').prop("disabled",false);
                            $('#btnModificar').prop("disabled",false);

                        } else {
                            $('#txtTitulo').prop("disabled",true);
                            $('#txtHora').prop("disabled",true);
                            $('#txtHoras').prop("disabled",true);
                            $('#txtColor').prop("disabled",true);
                            $('#btnAgregar').prop("disabled",true);
                            $('#btnBorrar').prop("disabled",true);
                            $('#btnModificar').prop("disabled",true);
                        }

                        $("#ModalEventos").modal();
                        CustomColorChange();
                    }

                    if (calEvent.type == "event") {

                        $('#txtTituloImportant').val(calEvent.title);
                        $('#txtColorImportant').val(calEvent.color);
                        $('#txtDescriptionImportant').val(calEvent.description);

                        $('#txtTituloImportant').prop("disabled",true);
                        $('#txtColorImportant').prop("disabled",true);
                        $('#txtDescriptionImportant').prop("disabled",true);
                        
                        $("#ModalEventosImportantes").modal();
                    }
                },

                events: 'eventos.php'

            });

        });

        var NuevoEvento;
        $('#btnAgregar').click(function() {
            NuevoEvento = RecolectarDatosGUI();
            EnviarInformacion('agregar', NuevoEvento);
        });

        $('#btnBorrar').click(function() {
            NuevoEvento = RecolectarDatosGUI();
            EnviarInformacion('eliminar', NuevoEvento);
        });

        $('#btnModificar').click(function() {
            NuevoEvento = RecolectarDatosGUI();
            EnviarInformacion('modificar', NuevoEvento);
        });

        function RecolectarDatosGUI() {

            var NuevoEvento = {
                id: $('#txtID').val(),
                title: $('#txtTitulo').val(),
                start: $('#txtFecha').val() + " " + $('#txtHora').val(),
                end: $('#txtFecha').val() + " " + $('#txtHora').val(),
                color: $('#txtColor').val(),
                horas: $('#txtHoras').val(),
                textColor: "#FFFFFF",
                priceHour: $('#priceHour').val(),
                type: "timesheet"
            };

            return NuevoEvento;

        };

        function limpiarFormulario() {

            $('#txtID').val("");
            $('#txtTitulo').val("Part d'hores");
            $('#txtFecha').val("");
            $('#txtHora').val("<?php echo $default_hour; ?>");
            $('#txtColor').val("#FDA04E");
            $('#txtHoras').val("");
            $('#priceHour').val("<?php echo $priceHour;?>");

        }

        function CustomColorChange() {

            $( "#txtTitulo" ).change(function() {

                var titulo = $('#txtTitulo').val();

                if (titulo == "Part d'hores") {
                    $('#txtColor').val('#FDA04E');

                } else if (titulo == 'Festa') {
                    $('#txtColor').val('#6AB187');

                } else if (titulo == 'Remot') {
                    $('#txtColor').val('#FDA04E');

                } else if (titulo == 'Startup Grind') {
                    $('#txtColor').val('#9771d1');
                }

            });
        }

        function EnviarInformacion(accion, objEvento) {

            $.ajax({
                type: 'POST',
                url: 'eventos.php?accion=' + accion,
                data: objEvento,
                success: function(msg) {
                    if (msg) {
                        $('#CalendarioWeb').fullCalendar('refetchEvents');
                        $("#ModalEventos").modal('toggle');
                        $('#info_table').load('/calendari/table.php');
                    }
                },
                error: function() {
                    alert("YA LA HAS LIADOOO HUEVOON!");
                }
            });
        };

    </script>

</body>

</html>