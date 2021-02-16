<?php session_start(); ?>
<?php
if (!empty($_POST)) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
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

        $args = "SELECT * FROM `info_users` WHERE `username` LIKE '$username'";
        $sql = mysqli_query($conn, $args);
        $rows=mysqli_fetch_assoc($sql);

        $_SESSION['table'] = $rows['table'];

        die(json_encode(array('success'=> 1, 'message' => "login")));

    } else {
        die(json_encode(array('success'=> 0, 'message' => "error")));
    }
}

?>