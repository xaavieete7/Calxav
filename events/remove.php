<?php


if ($_POST['id']) {
    $id = $_POST['id'];

    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
    $args = "DELETE FROM eventos_importantes WHERE id=".$id;
    $sql = mysqli_query($conn, $args);

    die(json_encode(array('success'=> 1, 'message' => "Event eliminat correctament")));

} else {

    die(json_encode(array('success'=> 1, 'message' => "S'ha produit un error inesperat")));
}

?>