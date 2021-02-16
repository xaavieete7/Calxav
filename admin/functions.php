<?php session_start(); ?>
<?php

switch($_POST['action']) {
    case "notifications":
        save_notificaions();
        break;
    
    case "remove_notification":
        remove_notification();
        break;
}

function save_notificaions() {

    if (!empty($_POST)) {

        $pdo=new PDO("mysql:dbname=dbs1366328;host=db5001646814.hosting-data.io","dbu1060335","Ionos123!");
    
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