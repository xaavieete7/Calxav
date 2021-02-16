<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();

    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("dashboard");

    $objDB = new DatabaseConn();
    $conn = $objDB->Connection();

    $rank = $_SESSION['rank'];

    if ($rank == 'user' | $rank == 'admin') {

        $dia = date("j");
        $mes = date("n");
        $any = date("o");
        $table = $_SESSION['table'];
        $username = $_SESSION['username'];
        
        //Hores avui
        $args = "SELECT SUM(`horas`) FROM `$table` WHERE DAY(`start`) = '$dia' AND MONTH(`start`) = '$mes' AND YEAR(`start`) = '$any'";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        $hores_avui = $rows['SUM(`horas`)'];
        if (empty($hores_avui)){
            $hores_avui = 0;
        }

        //Hores aquest mes
        $args = "SELECT SUM(`horas`) FROM `$table` WHERE MONTH(`start`) = '$mes' AND YEAR(`start`) = '$any'";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        $hores_mes = $rows['SUM(`horas`)'];
        if (empty($hores_mes)){
            $hores_mes = 0;
        }

        //Limit hores
        $args = "SELECT `max_hours` FROM `info_users` WHERE `username` LIKE '$username'";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        $hores_limit = $rows['max_hours'];
        if (empty($hores_limit)){
            $hores_limit = 0;
        }

        //Hores totals
        $args = "SELECT SUM(`horas`) FROM `$table`";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        $hores_total = $rows['SUM(`horas`)'];
        if (empty($hores_total)){
            $hores_total = 0;
        }

        //Hores limit
        $args = "SELECT `max_hours` FROM `info_users` WHERE `username` LIKE '$username'";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        $hores_limit = $rows['max_hours'];
        if (empty($hores_limit)){
            $hores_limit = 0;
        }

        //Hores restants
        $hores_restants = $hores_limit - $hores_total;

    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header -->
    <?php printf($obj->Head()); ?>
  
</head>

<body class="">
    <div class="wrapper ">
    
        <!-- Sidebar -->
        <?php printf($obj->Sidebar("dashboard")); ?>
        
        <div class="main-panel">

            <!-- Navbar -->
            <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <h4>Hola, <?php echo $_SESSION['firstname'] ?>! <hr></h4>

                    <?php 

                        if ($rank == 'user' | $rank == 'admin') {
                            $notificacion_rank = 'user';
                        } else {
                            $notificacion_rank = 'viewer';
                        }

                        //Show notificacions
                        $args = "SELECT * FROM `notificaciones` WHERE `visibility` LIKE '$notificacion_rank' OR `visibility` LIKE 'all'";
                        $sql = mysqli_query($conn, $args);
                        $html = "";

                        while ($rows=mysqli_fetch_assoc($sql)) {
                            $title = $rows['title'];
                            $content = $rows['content'];
                            $type = $rows['type'];
                            
                            $html .= '<div class="alert alert-'.$type.' alert-dismissible fade show p-3" role="alert">';
                                $html .= '<h4><strong>'.$title.'</strong></h4>';
                                $html .= '<p class="mb-0">'.$content.'</p>';
                                $html .= '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                    $html .= '<span aria-hidden="true">&times;</span>';
                                $html .= '</button>';
                            $html .= '</div>';
                        }

                        print($html);
                    
                    ?>


                    <?php if ($rank != 'viewer') { ?>

                        <div class="row justify-center">

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header card-header-danger card-header-icon">
                                        <div class="card-icon">
                                            <i class="material-icons">today</i>
                                        </div>
                                        <p class="card-category">Hores avui</p>
                                        <h2 class="card-title"><?php echo $hores_avui; ?>
                                            <small>h</small>
                                        </h2>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header card-header-danger card-header-icon">
                                        <div class="card-icon">
                                            <i class="material-icons">date_range</i>
                                        </div>
                                        <p class="card-category">Hores mes</p>
                                        <h2 class="card-title"><?php echo $hores_mes; ?>
                                            <small>h</small>
                                        </h2>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header card-header-danger card-header-icon">
                                        <div class="card-icon">
                                            <i class="material-icons">alarm</i>
                                        </div>
                                        <p class="card-category">Hores totals</p>
                                        <h2 class="card-title"><?php echo $hores_total; ?>
                                            <small>h</small>
                                        </h2>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-stats">
                                    <div class="card-header card-header-danger card-header-icon">
                                        <div class="card-icon">
                                            <i class="material-icons">timeline</i>
                                        </div>
                                        <p class="card-category">Hores restants</p>
                                        <h2 class="card-title"><?php echo $hores_restants; ?>
                                            <small>h</small>
                                        </h2>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="card card-chart">
                                    <div class="card-header card-header-danger">
                                        <div class="ct-chart" id="dailySalesChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Salari mes passat</h4>
                                        <p class="card-category">
                                        T'has quedat a un <span class="text-success"> 55% </span> del teu objectiu.</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card card-chart">
                                    <div class="card-header card-header-danger">
                                        <div class="ct-chart" id="websiteViewsChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Salari</h4>
                                        <p class="card-category">Estas a Xh. de complir el teu objectiu</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card card-chart">
                                    <div class="card-header card-header-danger">
                                        <div class="ct-chart" id="completedTasksChart"></div>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">Salari mes que ve</h4>
                                        <p class="card-category">Conseguiras el teu objectiu?</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="stats"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } else {

                        //Rank = viewer

                        $args = 'SELECT * FROM `info_users`';
                        $sql_users = mysqli_query($conn, $args);
                        $html = '<div class="mt-4">';

                            while ($rows=mysqli_fetch_assoc($sql_users)) { 

                                $dia = date("j");
                                $mes = date("n");
                                $any = date("o");
                                $table = $rows['table'];
                                $username = $rows['username'];

                                //Hores avui
                                $args = "SELECT SUM(`horas`) FROM `$table` WHERE DAY(`start`) = '$dia' AND MONTH(`start`) = '$mes' AND YEAR(`start`) = '$any'";
                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $hores_avui = $rows['SUM(`horas`)'];
                                if (empty($hores_avui)){
                                    $hores_avui = 0;
                                }

                                //Hores aquest mes
                                $args = "SELECT SUM(`horas`) FROM `$table` WHERE MONTH(`start`) = '$mes' AND YEAR(`start`) = '$any'";
                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $hores_mes = $rows['SUM(`horas`)'];
                                if (empty($hores_mes)){
                                    $hores_mes = 0;
                                }

                                //Limit hores
                                $args = "SELECT `max_hours` FROM `info_users` WHERE `username` LIKE '$username'";
                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $hores_limit = $rows['max_hours'];
                                if (empty($hores_limit)){
                                    $hores_limit = 0;
                                }

                                //Hores totals
                                $args = "SELECT SUM(`horas`) FROM `$table`";
                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $hores_total = $rows['SUM(`horas`)'];
                                if (empty($hores_total)){
                                    $hores_total = 0;
                                }

                                //Hores limit
                                $args = "SELECT `max_hours` FROM `info_users` WHERE `username` LIKE '$username'";
                                $sql = mysqli_query($conn, $args);
                                $rows = mysqli_fetch_assoc($sql);
                                $hores_limit = $rows['max_hours'];
                                if (empty($hores_limit)){
                                    $hores_limit = 0;
                                }

                                //Hores restants
                                $hores_restants = $hores_limit - $hores_total;

                                $html .= '<h4 class="">'.ucfirst($username).'</h4><hr>';

                                $html .= '<div class="row justify-center">';

                                    $html .= '<div class="col-lg-3 col-md-6 col-sm-6">';
                                        $html .= '<div class="card card-stats">';
                                            $html .= '<div class="card-header card-header-danger card-header-icon">';
                                                $html .= '<div class="card-icon">';
                                                    $html .= '<i class="material-icons">today</i>';
                                                $html .= '</div>';
                                                $html .= '<p class="card-category">Hores avui</p>';
                                                $html .= '<h2 class="card-title">'. $hores_avui .'';
                                                    $html .= '<small>h</small>';
                                                $html .= '</h2>';
                                            $html .= '</div>';
                                            $html .= '<div class="card-footer">';
                                                $html .= '<div class="stats"></div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    $html .= '<div class="col-lg-3 col-md-6 col-sm-6">';
                                        $html .= '<div class="card card-stats">';
                                            $html .= '<div class="card-header card-header-danger card-header-icon">';
                                                $html .= '<div class="card-icon">';
                                                    $html .= '<i class="material-icons">date_range</i>';
                                                $html .= '</div>';
                                                $html .= '<p class="card-category">Hores mes</p>';
                                                $html .= '<h2 class="card-title">'. $hores_mes .'';
                                                    $html .= '<small>h</small>';
                                                $html .= '</h2>';
                                            $html .= '</div>';
                                            $html .= '<div class="card-footer">';
                                                $html .= '<div class="stats"></div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    $html .= '<div class="col-lg-3 col-md-6 col-sm-6">';
                                        $html .= '<div class="card card-stats">';
                                            $html .= '<div class="card-header card-header-danger card-header-icon">';
                                                $html .= '<div class="card-icon">';
                                                    $html .= '<i class="material-icons">alarm</i>';
                                                $html .= '</div>';
                                                $html .= '<p class="card-category">Hores totals</p>';
                                                $html .= '<h2 class="card-title">'. $hores_total .'';
                                                    $html .= '<small>h</small>';
                                                $html .= '</h2>';
                                            $html .= '</div>';
                                            $html .= '<div class="card-footer">';
                                                $html .= '<div class="stats"></div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                    $html .= '<div class="col-lg-3 col-md-6 col-sm-6">';
                                        $html .= '<div class="card card-stats">';
                                            $html .= '<div class="card-header card-header-danger card-header-icon">';
                                                $html .= '<div class="card-icon">';
                                                    $html .= '<i class="material-icons">timeline</i>';
                                                $html .= '</div>';
                                                $html .= '<p class="card-category">Hores restants</p>';
                                                $html .= '<h2 class="card-title">'. $hores_restants .'';
                                                    $html .= '<small>h</small>';
                                                $html .= '</h2>';
                                            $html .= '</div>';
                                            $html .= '<div class="card-footer">';
                                                $html .= '<div class="stats"></div>';
                                            $html .= '</div>';
                                        $html .= '</div>';
                                    $html .= '</div>';

                                $html .= '</div>';

                            }
                        $html .= '</div>';

                        print($html);

                    }?>
                </div>
            </div>
        </div>
    </div>

  <!-- Footer src -->
  <?php printf($obj->Footerlinks()); ?>

    <script>
        $(document).ready(function() {
            $().ready(function() {

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    </script>
  
</body>

</html>