<?php session_start(); ?>
<?php
$objDB = new DatabaseConn();
$conn = $objDB->Connection();

if (empty($_POST)) {
    die(json_encode(array('success'=> 0, 'message'=> 'Error! Torna-ho a provar en un altre moment')));
}

if (empty($_POST['oldPass'])) {
    die(json_encode(array('success'=> 0, 'message'=> 'Un o més camps esta buit')));
}

if (empty($_POST['newPass'])) {
    die(json_encode(array('success'=> 0, 'message'=> 'Un o més camps esta buit')));
}

if (empty($_POST['repetePass'])) {
    die(json_encode(array('success'=> 0, 'message'=> 'Un o més camps esta buit')));
}

//Password antic
$user_id = $_SESSION['user_id'];
$args = "SELECT `password` FROM `users` WHERE `id` LIKE '$user_id'";
$sql = mysqli_query($conn, $args);
$rows = mysqli_fetch_assoc($sql);
$old_password_db = $rows['password'];

$old_password = md5($_POST['oldPass']);
$new_password = md5($_POST['newPass']);
$repeat_password = md5($_POST['repetePass']);

if ($old_password != $old_password_db) {
    die(json_encode(array('success'=> 0, 'message'=> 'La contrasenya anterior no concideix')));
}

if ($old_password == $new_password) {
    die(json_encode(array('success'=> 0, 'message'=> 'La nova contrasenya no pot ser la mateixa que l\'anterior')));
}

if ($new_password != $repeat_password) {
    die(json_encode(array('success'=> 0, 'message'=> 'Les contrasenyas no coinsideixen')));
}

//Canviem per el nou
$args = "UPDATE `users` SET `password`='$new_password' WHERE `id` LIKE '$user_id'";
$sql = mysqli_query($conn, $args);

die(json_encode(array('success'=> 1, 'message'=> 'Els canvis s\'han guardat correctament')));

?>
