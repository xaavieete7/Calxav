<?php session_start(); ?>
<?php require('../static.php'); 
    $obj = new NavBar();
    
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("estadistiques");

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

</head>

<body class="">

    <div class="wrapper">
        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("estadistiques")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>
            
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title ">Estadístiques</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">

                                        <?php
                                            $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");

                                            $objTable = new TableArray();
                                            $meses = $objTable->ArrayMonth();
                                            $table = $_SESSION['table'];

                                            $html = '<table class="table text-center">';

                                                $html .= '<thead>';
                                                    $html .= '<tr>';
                                                        $html .= '<th>Mes</th>';
                                                        $html .= '<th>Hores</th>';
                                                        $html .= '<th>Salari</th>';
                                                    $html .= '</tr>';
                                                $html .= '</thead>';

                                                $html .= '<tbody>';

                                                    foreach ($meses as $mes => $num) {

                                                        //Horas
                                                        $args = "SELECT SUM(horas) FROM `$table` WHERE MONTH(`start`) = $num[0] AND YEAR(`start`) = $num[1]";
                                                        $sql = mysqli_query($conn, $args);
                                                        $rows = mysqli_fetch_assoc($sql);
                                                        $horas = $rows['SUM(horas)'];

                                                        //Salario
                                                        $args = "SELECT SUM(salary) FROM `$table` WHERE MONTH(`start`) = $num[0] AND YEAR(`start`) = $num[1]";
                                                        $sql = mysqli_query($conn, $args);
                                                        $rows = mysqli_fetch_assoc($sql);
                                                        $salari = $rows['SUM(salary)'];
                                                        
                                                        if ($horas) {
                                                            $html .= '<tr>';
                                                                $html .= '<td>' . $mes .'</td>';
                                                                $html .= '<td>' . $horas . 'h</td>';
                                                                $html .= '<td>' . $salari . '€</td>';
                                                            $html .= '</tr>';
                                                        }
                                                    }

                                                $html .= '</tbody>';

                                                $args = "SELECT SUM(horas) FROM `$table`";
                                                $sql = mysqli_query($conn, $args);
                                                $rows = mysqli_fetch_assoc($sql);

                                                $horas_totals = $rows['SUM(horas)'];

                                                $args = "SELECT SUM(salary) FROM `$table`";
                                                $sql = mysqli_query($conn, $args);
                                                $rows = mysqli_fetch_assoc($sql);

                                                $salari_total = $rows['SUM(salary)'];

                                                $html .= '<tr>';
                                                    $html .= '<td>TOTAL</td>';
                                                    $html .= '<td>' . $horas_totals . 'h</td>';
                                                    $html .= '<td>' . $salari_total . '€</td>';
                                                $html .= '</tr>';

                                            $html .= '<table>';

                                            print($html);
                                        ?>
                                    </div> 
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