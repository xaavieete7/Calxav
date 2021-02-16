<?php session_start(); ?>
<?php 

if (!empty($_POST)) {

    if (empty($_POST['title'])) {
        die(json_encode(array('success'=> 0, 'message' => "El títol no pot estar buit")));
    }

    $pdo=new PDO("mysql:dbname=dbs1366328;host=db5001646814.hosting-data.io","dbu1060335","Ionos123!");

    $sentenciaSQL = $pdo->prepare("INSERT INTO eventos_importantes(`title`, `description`, `color`, `textcolor`, `start`, `end`, `type`) VALUES (:title, :description, :color, :textColor, :start, :end, :type)");

    $respuesta = $sentenciaSQL->execute(array(

        "title" => $_POST['title'],
        "description" => $_POST['description'],
        "color" => $_POST['color'],
        "textColor" => "#FFFFFF",
        "start" => $_POST['start'],
        "end" => $_POST['start'],
        "type" => $_POST['txtType']
    ));

    die(json_encode(array('success'=> 1, 'message' => "El event s'ha afegit correctament")));

}




?>