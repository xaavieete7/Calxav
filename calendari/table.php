<?php session_start(); ?>
<?php require_once('../static.php'); ?>
<?php
$objDB = new DatabaseConn();
$conn = $objDB->Connection();
$user_id = $_SESSION['user_id'];

if ($_SESSION['rank'] == 'viewer') {

    $cal = $_SESSION['cal'];
    $args = "SELECT * FROM `users` WHERE `username` LIKE '$cal'";
    $sql = mysqli_query($conn, $args);
    $rows = mysqli_fetch_assoc($sql);
    $user_id = $rows['id'];
}

$html = '';

//Get the number of the month and the year
$num_mes = date("n");
$num_any = date("Y");

//Horas
$args = "SELECT SUM(horas) FROM `eventos` WHERE `user_id` = '$user_id' AND MONTH(`start`) = '$num_mes' AND YEAR(`start`) = '$num_any'";
$sql = mysqli_query($conn, $args);
$rows = mysqli_fetch_assoc($sql);
$horas = $rows['SUM(horas)'];
if (empty($horas)){
    $horas = 0;
}

//Salario
$args = "SELECT SUM(salary) FROM `eventos` WHERE `user_id` = '$user_id' AND MONTH(`start`) = '$num_mes' AND YEAR(`start`) = '$num_any'";
$sql = mysqli_query($conn, $args);
$rows = mysqli_fetch_assoc($sql);
$salari = $rows['SUM(salary)'];
if (empty($salari)){
    $salari = 0;
}

$name_month = array(
    1 => 'Gener',
    2 => 'Febrer',
    3 => 'Març',
    4 => 'Abril',
    5 => 'Maig',
    6 => 'Juny',
    7 => 'Juliol',
    8 => 'Agost',
    9 => 'Setembre',
    10 => 'Octubre',
    11 => 'Novembre',
    12 => 'Desembre'
);

$html .= '<table class="table">';
    $html .= '<thead>';
        $html .= '<tr>';
            $html .= '<th>Mes</th>';
            $html .= '<th>Hores</th>';
            $html .= '<th>Salari</th>';
        $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
        $html .= '<tr>';
            $html .= '<td>' . $name_month[$num_mes] .'</td>';
            $html .= '<td>' . $horas . 'h</td>';
            $html .= '<td>' . $salari . '€</td>';
        $html .= '</tr>';
    $html .= '</tbody>';
$html .= '</table>';

print($html);