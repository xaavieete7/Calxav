<?php session_start(); ?>
<?php require_once('../static.php'); 
    $obj = new NavBar();
  
    //Redirect if is not logged
    $objSecurity = new Security();
    $objSecurity->Logintime("equip");

    $objDB = new DatabaseConn();
    $conn = $objDB->Connection();
    $args = "SELECT * FROM `users` WHERE `is_public` LIKE 'true'";
    $sql = mysqli_query($conn, $args);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Header -->
  <?php printf($obj->Head()); ?>
  <link href="../assets/css/equip.css" rel="stylesheet" />

</head>

<body class="">
    <div class="wrapper ">
    
        <!-- Sidebar -->
        <?php printf($obj->Sidebar("equip")); ?>

        <div class="main-panel">

            <!-- Navbar -->
            <?php printf($obj->Navbar()); ?>
        
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-center">
                        <div class="col-md-10 card-container">
                            <div class="card">
                                <div class="card-header card-header-danger">
                                    <h4 class="card-title">Equip</h4>
                                </div>

                                <div class="card-body">

                                    <div class="form-row mt-3">
                                        <?php
                                            while ($rows=mysqli_fetch_assoc($sql)) {
                                                $user_id = $rows['id'];
                                                $rank = $rows['rank'];
                                                $username = $rows['username'];
                                                $firstname = $rows['firstname'];
                                                $lastname = $rows['lastname'];
                                                $empresa = $rows['empresa'];
                                                $last_conn = $rows['last_connection'];

                                                $html .= '<div class="card-container col-md-6">';
                                                    $html .= '<div class="card-body team-card mb-4">';

                                                        $html .= '<div class="form-row">';

                                                            $html .= '<div class="form-group col-md-6">';
                                                                $html .= '<div class="form-group text-center col-md-12 p-0 m-0">';
                                                                    $html .= '<img class="profile-img" src="/assets/img/default_img.jpg" alt="">';
                                                                $html .= '</div>';
                                                            $html .= '</div>';

                                                            $html .= '<div class="form-group col-md-6">';
                                                                
                                                                $html .= '<div class="form-group col-md-12 m-0 text-center">';
                                                                    $html .= '<span>'. $firstname . ' ' . $lastname .'</span>';
                                                                $html .= '</div>';

                                                                $html .= '<div class="form-group col-md-12 m-0 text-center">';
                                                                    $html .= '<span>'. $empresa . '</span>';
                                                                $html .= '</div>';

                                                                $html .= '<div class="form-group col-md-12 m-0 text-right">';
                                                                    $html .= '<a href="/user?profile='.$username.'" class="text-danger">Veure el perfil</a>';
                                                                $html .= '</div>';

                                                            $html .= '</div>';
                                                        $html .= '</div>';
                                                    $html .= '</div>';
                                                $html .= '</div>';
                                            }
                                            print($html);
                                        ?>
                                    </div>
                                </div>
                            </div>
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