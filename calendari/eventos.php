<?php session_start(); ?>
<?php require_once('../static.php'); ?>
<?php
header("Content-Type: application/json");

$accion = (isset($_GET['accion']))?$_GET['accion']:"leer";

$objDB = new DatabaseConn();
$pdo = $objDB->ConnectionPDO();

switch($accion) {

    case 'agregar':
        //Agregar
        $table = $_SESSION['table'];
        $sentenciaSQL = $pdo->prepare("INSERT INTO `eventos` (`user_id`, `title`, `horas`, `color`, `textColor`, `priceHour`, `salary`, `start`, `end`, `type`) VALUES (:user_id ,:title, :horas, :color, :textColor, :priceHour, :salary, :start, :end, :type)");

        $respuesta = $sentenciaSQL->execute(array(

            "user_id" => $_POST['user_id'],
            "title" => $_POST['title'],
            "horas" => $_POST['horas'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "priceHour" => $_POST['priceHour'],
            "salary" => floatval($_POST['horas']) * floatval($_POST['priceHour']),
            "start" => $_POST['start'],
            "end" => $_POST['end'],
            "type" => $_POST['type']
        ));

        echo json_encode($respuesta);

    break;

    case 'eliminar':

        //Eliminar
        $respuesta = false;

        if(isset($_POST['id'])){

            $table = $_SESSION['table'];
            $sentenciaSQL = $pdo->prepare("DELETE FROM `eventos` WHERE id=:ID");
            $respuesta = $sentenciaSQL->execute(array("ID"=>$_POST['id']));
        }

        echo json_encode($respuesta);

    break;

    case 'modificar':

        //Modificar
        $table = $_SESSION['table'];
        $sentenciaSQL = $pdo->prepare("UPDATE `eventos` SET `title`=:title, `horas`=:horas, `color`=:color, `textColor`=:textColor, `priceHour`=:priceHour, `salary`=:salary, `start`=:start, `end`=:end WHERE `id`=:ID");
        $respuesta = $sentenciaSQL->execute(array(

            "ID" => $_POST['id'],
            "title" => $_POST['title'],
            "horas" => $_POST['horas'],
            "color" => $_POST['color'],
            "textColor" => $_POST['textColor'],
            "priceHour" => $_POST['priceHour'],
            "salary" => floatval($_POST['horas']) * floatval($_POST['priceHour']),
            "start" => $_POST['start'],
            "end" => $_POST['end']
        ));

        echo json_encode($respuesta);
        
    break;
    default:

        $rank = $_SESSION['rank'];

        if ($rank == 'viewer') {

            $user = $_SESSION['cal'];

            //PROBLEMA
            $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
            $args = "SELECT `id` FROM `users` WHERE `username` LIKE '$user'";
            $sql = mysqli_query($conn, $args);
            $rows = mysqli_fetch_assoc($sql);
            $user_id = $rows['id'];
            
            $args = $pdo->prepare("SELECT * FROM `eventos` WHERE `user_id` LIKE '$user_id'");
            $args->execute();
            $resultado = $args->fetchAll(PDO::FETCH_ASSOC);

            echo json_encode($resultado);

        } else {

            $user_id = $_SESSION['user_id'];
            $args = $pdo->prepare("SELECT * FROM `eventos` WHERE `user_id` LIKE '$user_id'");
            $args->execute();
            $resultado = $args->fetchAll(PDO::FETCH_ASSOC);

            $args_imp = $pdo->prepare("SELECT * FROM eventos_importantes");
            $args_imp->execute();
            $resultado_imp = $args_imp->fetchAll(PDO::FETCH_ASSOC);
            
            $resultado_final = array_merge($resultado, $resultado_imp);
            echo json_encode($resultado_final);

        }
    break;

};

?>