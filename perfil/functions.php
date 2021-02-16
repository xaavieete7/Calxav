<?php session_start(); ?>
<?php

if ($_POST['action'] == 'public_info') { form_profile_save(); }

function form_profile_save(){

    if (empty($_POST['firstname'])) {
        die(json_encode(array('success'=> 0, 'message' => 'El nom es obligatori')));
    }

    if (empty($_POST['terms'])) {
        die(json_encode(array('success'=> 0, 'message' => 'Accepta els termes i condicions')));
    }

    $username       = $_SESSION['username'];
    $firstname      = $_POST['firstname'];
    $lastname       = $_POST['lastname'];
    $email          = $_POST['email'];
    $data_neixament = $_POST['data_neixament'];
    $empresa        = $_POST['company'];
    $ciutat         = $_POST['city'];
    $color          = $_POST['color'];
    $carrec         = $_POST['carrec'];
    $is_public      = $_POST['is_public'];

    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");

    $args = "UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`data_neixament`='$data_neixament',`empresa`='$empresa',`ciutat`='$ciutat',`color_preferit`='$color',`carrec`='$carrec',`is_public`='$is_public'  WHERE `username` LIKE '$username'";
    $sql = mysqli_query($conn, $args);

    die(json_encode(array('success'=> 1, 'message' => 'Els canvis s\'han guardat correctament')));

}

?>