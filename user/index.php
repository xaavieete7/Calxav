<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();

    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("equip");

    //Public info profile
    $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");
    $username = $_GET['profile'];

    if (!empty($username)) {

        $args = "SELECT * FROM `users` WHERE `username` LIKE '$username' AND `is_public` LIKE 'true'";
        $sql = mysqli_query($conn, $args);
        $rows = mysqli_fetch_assoc($sql);

        if (!empty($rows)) {
            
            $id = $rows['id'];
            $firstname = $rows['firstname'];
            $lastname = $rows['lastname'];
            $email = $rows['email'];
            $data_neixament = $rows['data_neixament'];
            $empresa = $rows['empresa'];
            $ciutat = $rows['ciutat'];
            $color = $rows['color_preferit'];
            $carrec = $rows['carrec'];

        } else {
            header('Location: /404.php');
        }

    } else {
        header('Location: /404.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Header -->
	<?php printf($obj->Head()); ?>
    <link href="../assets/css/user.css" rel="stylesheet" />

</head>

<body class="">

    <div class="wrapper">

        <!-- Sidebar -->
	    <?php printf($obj->Sidebar("")); ?>

        <div class="main-panel">

            <!-- Navbar -->
	        <?php printf($obj->Navbar()); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title "><?php echo $firstname .' '. $lastname; ?></h4>
                                    <p class="card-category"><?php echo $carrec; ?></p>
                                </div>
                                <div class="card-body">
                                    <form id="form" class="mt-4">
                                        <div class="form-row">

                                            <div class="form-group col-md-6 mb-4">

                                                <div class="form-group text-center col-md-12 mb-4">
                                                    <img class="profile-img" src="/assets/img/default_img.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6 mb-4">

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <a class="user-info-box nav-link">
                                                            <i class="material-icons">alternate_email</i>
                                                            <span><?php echo $email; ?></span>
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <a class="user-info-box nav-link">
                                                            <i class="material-icons">cake</i>
                                                            <span><?php echo $data_neixament; ?></span>
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <a class="user-info-box nav-link">
                                                            <i class="material-icons">business</i>
                                                            <span><?php echo $empresa; ?></span>
                                                        </a>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4 mb-4">
                                                        <a class="user-info-box nav-link">
                                                            <i class="material-icons">location_city</i>
                                                            <span><?php echo $ciutat; ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <div>
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer src -->
    <?php printf($obj->Footerlinks()); ?>

</body>

</html>
