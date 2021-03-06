<?php session_start(); ?>
<?php require_once('../static.php');

switch($_POST['action']) {
    case "notifications":
        save_notificaions();
        break;
    
    case "remove_notification":
        remove_notification();
        break;
    
    case "create_user":
        create_user();
        break;
}




function create_user() {

    if (!empty($_POST['rank'])) {
        $rank = $_POST['rank'];
        if (!empty($_POST['name'])){$name = $_POST['name'];} else {die(json_encode(array('success'=> 0, 'message' => "Hi ha hagut un error amb el nom d'usuari")));}
        if (!empty($_POST['username'])){$username = $_POST['username'];} else {die(json_encode(array('success'=> 0, 'message' => "Hi ha hagut un error amb el nom d'usuari")));}
        if (!empty($_POST['password'])){$password = $_POST['password'];} else {die(json_encode(array('success'=> 0, 'message' => "Hi ha hagut un error amb la contrasenya")));}
        if ($rank == "viewer") {
            $hour_price = "";
            $hour_total = "";    
        } else {
            if (!empty($_POST['hour_price'])){$hour_price = $_POST['hour_price'];} else {die(json_encode(array('success'=> 0, 'message' => "Hi ha hagut un error amb el preu hora")));}
            if (!empty($_POST['hour_total'])){$hour_total = $_POST['hour_total'];} else {die(json_encode(array('success'=> 0, 'message' => "Hi ha hagut un error amb les hores totals")));}
        }
    
        $objDB = new DatabaseConn();
        $pdo = $objDB->ConnectionPDO();
        $conn = $objDB->Connection();
        $args = "SELECT `username` FROM `users` WHERE `username` = '$username' ";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);
        if ($rows != 0) {
            die(json_encode(array('success'=> 0, 'message' =>  "Aquest usuari ja existeix a la base de dades")));
        }

        $pdo = $objDB->ConnectionPDO();
        $sentenciaSQL = $pdo->prepare("INSERT INTO users(`rank`,  `username`, `firstname`, `password`, `priceHour`, `max_hours` ) VALUES (:rank, :username, :firstname, :password, :priceHour, :max_hours)");

        $respuesta = $sentenciaSQL->execute(array(

            "rank" => $rank,
            "username" => $username,
            "firstname" => $name,
            "password" => md5($password),
            "priceHour" => $hour_price,
            "max_hours" => $hour_total
        ));
        
        die(json_encode(array('success'=> 1, 'message' => "L'usuari ha sigut creat satisfactoriament")));   
    }

    die(json_encode(array('success'=> 0, 'message' => "No s'ha pogut crear l'usuari, torna a intentar-ho")));

    
}

function save_notificaions() {

    if (!empty($_POST)) {

        $objDB = new DatabaseConn();
        $pdo = $objDB->ConnectionPDO();
    
        $sentenciaSQL = $pdo->prepare("INSERT INTO notificaciones(`title`, `content`, `visibility`, `type`) VALUES (:title, :content, :visibility, :type)");
    
        $respuesta = $sentenciaSQL->execute(array(

            "title" => $_POST['title'],
            "content" => $_POST['content'],
            "visibility" => $_POST['visibility'],
            "type" => $_POST['type']
        ));
    
        die(json_encode(array('success'=> 1, 'message' => "La notificació s'ha afegit correctament")));
    
    }

}

function remove_notification() {

    if ($_POST['id']) {
        $id = $_POST['id'];

        $objDB = new DatabaseConn();
        $conn = $objDB->Connection();
        $args = "DELETE FROM `notificaciones` WHERE id=".$id;
        $sql = mysqli_query($conn, $args);
    
        die(json_encode(array('success'=> 1, 'message' => "Notificacio eliminada correctament")));
    
    } else {
        die(json_encode(array('success'=> 0, 'message' => "S'ha produit un error inesperat")));
    }
}

?>