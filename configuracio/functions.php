<?php session_start(); ?>
<?php

if ($_POST['action'] == 'form_contract') { form_contract_save(); }
if ($_POST['action'] == 'form_calendar') { form_calendar_save(); }

function form_contract_save(){

    if ($_SESSION['rank'] == 'admin' || $_SESSION['rank'] == 'user') {

        if (empty($_POST['priceHour']) | empty($_POST['salary_target']) | empty($_POST['max_hours'])) {
            die(json_encode(array('success'=> 0, 'message' => 'No pots guardar un valor buit')));
        }

        require_once('../static.php');

        $username = $_SESSION['username'];
        $priceHour = $_POST['priceHour'];
        $salary_target = $_POST['salary_target'];
        $max_hours = $_POST['max_hours'];

        $objDB = new DatabaseConn();
        $conn = $objDB->Connection();

        $args = "UPDATE `users` SET `priceHour`='$priceHour', `salary_target`='$salary_target', `max_hours`='$max_hours' WHERE `username` LIKE '$username'";
        $sql = mysqli_query($conn, $args);

        die(json_encode(array('success'=> 1, 'message' => 'Els canvis s\'han guardat correctament')));

    } else {

        die(json_encode(array('success'=> 0, 'message' => 'Sembla que no tens suficients permisos')));
    }

}

function form_calendar_save() {

    if ($_SESSION['rank'] == 'admin' || $_SESSION['rank'] == 'user') {

        require_once('../static.php');
        $username = $_SESSION['username'];
        $default_hour = $_POST['default_hour'];

        $objDB = new DatabaseConn();
        $conn = $objDB->Connection();

        $args = "UPDATE `users` SET `default_hour`='$default_hour' WHERE `username` LIKE '$username'";
        $sql = mysqli_query($conn, $args);

        die(json_encode(array('success'=> 1, 'message' => 'Els canvis s\'han guardat correctament')));

    } else {

        die(json_encode(array('success'=> 0, 'message' => 'Sembla que no tens suficients permisos')));
    }
}

?>