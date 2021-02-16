<?php require_once('../static.php'); ?>
<?php

if ($_POST['id']) {
    $id = $_POST['id'];

    $objDB = new DatabaseConn();
    $conn = $objDB->Connection();
    $args = "DELETE FROM eventos_importantes WHERE id=".$id;
    $sql = mysqli_query($conn, $args);

    die(json_encode(array('success'=> 1, 'message' => "Event eliminat correctament")));

} else {

    die(json_encode(array('success'=> 1, 'message' => "S'ha produit un error inesperat")));
}

?>