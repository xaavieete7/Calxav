<?php session_start(); ?>
<?php require_once('../static.php'); ?>
<?php
if (!empty($_POST)) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $objDB = new DatabaseConn();
    $conn = $objDB->Connection();
    $args = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
    $sql = mysqli_query($conn, $args);

    $rows=mysqli_fetch_assoc($sql);

    if ($username == $rows['username'] && $password == $rows['password']) {

        $_SESSION["user_id"] = $rows['id'];
        $_SESSION['username'] = $rows['username'];
        $_SESSION['firstname'] = $rows['firstname'];
        
        $_SESSION['rank'] = $rows['rank'];
        $_SESSION["login_time"] = time();
        $_SESSION['last_session'] = date("d-m-Y H:i:s");
        $last_session = $_SESSION['last_session'];

        $args_last_session = "UPDATE `users` SET `last_connection`='$last_session' WHERE `username` LIKE '$username'";
        $sql_last_session = mysqli_query($conn, $args_last_session);

        die(json_encode(array('success'=> 1, 'message' => "login")));

    } else {
        die(json_encode(array('success'=> 0, 'message' => "error")));
    }
}

?>