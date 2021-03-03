<?php session_start(); ?>
<?php
class NavBar {

    public function Head() {

        $html = '<meta charset="utf-8" />';
        $html .= '<link rel="apple-touch-icon" sizes="76x76" href="../favicon.png">';
        $html .= '<link rel="icon" type="image/png" href="../favicon.png">';
        $html .= '<title>Calxav - qBID more big</title>';
        $html .= '<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />';
        //Fonts and icons
        $html .= '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />';
        $html .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">';
        //CSS Files
        $html .= '<link href="../assets/css/material-dashboard.css" rel="stylesheet" />';
        $html .= '<link href="../assets/css/front.css" rel="stylesheet" />';
        //Jquery
        $html .= '<script src="../assets/js/core/jquery.min.js"></script>';
        //Favicon
        $html .= '<link rel="shortcut icon" type="image/png" href="../favicon.png">';

        return $html;
    }

    public function Navbar() {

        $html = '<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">';
            $html .= '<div class="container-fluid">';
                $html .= '<div class="navbar-wrapper">';
                    $html .= '<a class="navbar-brand hide-brand-name" href="javascript:;">Calxav - qBID more big</a>';
                $html .= '</div>';
                $html .= '<button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">';
                    $html .= '<span class="sr-only">Toggle navigation</span>';
                    $html .= '<span class="navbar-toggler-icon icon-bar"></span>';
                    $html .= '<span class="navbar-toggler-icon icon-bar"></span>';
                    $html .= '<span class="navbar-toggler-icon icon-bar"></span>';
                $html .= '</button>';
            $html .= '</div>';
        $html .= '</nav>';

        return $html;
    }

    public function Sidebar($page) {

        switch($page) {
            case "dashboard":
                $dashboard = "active";
                break;
            case "configuracio":
                $configuracio = "active";
                break;
            case "equip":
                $equip = "active";
                break;
            case "perfil":
                $perfil = "active";
                break;
            case "calendari":
                $calendari = "active";
                break;
            case "events":
                $events = "active";
                break;
            case "seguretat":
                $seguretat = "active";
                break;
            case "administracio":
                $administracio = "active";
                break;
            case "estadistiques":
                $estadistiques = "active";
                break;
        }

        $rank = $_SESSION['rank'];
        
        $html = '<div class="sidebar" data-color="danger" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">';

            $html .= '<div class="logo">';
                $html .= '<a href="/dashboard" class="simple-text logo-normal">Calxav - qBID more big</a>';
            $html .= '</div>';

            $html .= '<div class="sidebar-wrapper">';
                $html .= '<ul class="nav">';

                    $html .= '<li class="nav-item '.$dashboard.'">';
                        $html .= '<a class="nav-link" href="/dashboard">';
                            $html .= '<i class="material-icons">dashboard</i>';
                            $html .= '<p>Dashboard</p>';
                        $html .= '</a>';
                    $html .= '</li>';

                    $html .= '<li class="nav-item '.$calendari.'">';
                        $html .= '<a class="nav-link" href="/calendari">';
                            $html .= '<i class="material-icons">calendar_today</i>';
                            $html .= '<p>Calendari</p>';
                        $html .= '</a>';
                    $html .= '</li>';

                    if ($rank == 'viewer') {

                        $objDB = new DatabaseConn();
                        $conn = $objDB->Connection();
                        $args = "SELECT `username` FROM users WHERE `rank` = 'user'";
                        $sql = mysqli_query($conn, $args);

                        while ($rows=mysqli_fetch_assoc($sql)) { 

                            $html .= '<li class="nav-item sub-nav-item">';
                                $html .= '<a class="nav-link sub-nav-link" href="/calendari?cal='.$rows['username'].'">';
                                    $html .= '<p>'.ucfirst($rows['username']).'</p>';
                                $html .= '</a>';
                            $html .= '</li>';

                        } 

                    } else {

                        $html .= '<li class="nav-item '.$events.'">';
                            $html .= '<a class="nav-link" href="/eventos">';
                                $html .= '<i class="material-icons">event</i>';
                                $html .= '<p>Events</p>';
                            $html .= '</a>';
                        $html .= '</li>';

                    }

                    $html .= '<li class="nav-item '.$perfil.'">';
                        $html .= '<a class="nav-link" href="/perfil">';
                            $html .= '<i class="material-icons">person</i>';
                            $html .= '<p>Perfil</p>';
                        $html .= '</a>';
                    $html .= '</li>';

                    if ($rank != 'viewer') {

                        $html .= '<li class="nav-item sub-nav-item '.$estadistiques.'">';
                            $html .= '<a class="nav-link sub-nav-link" href="/estadistiques">';
                                $html .= '<p>Estadístiques</p>';
                            $html .= '</a>';
                        $html .= '</li>';
                    }
                    $html .= '<li class="nav-item '.$equip.'">';
                        $html .= '<a class="nav-link" href="/equip">';
                            $html .= '<i class="material-icons">supervisor_account</i>';
                            $html .= '<p>Equip</p>';
                        $html .= '</a>';
                    $html .= '</li>';

                    if ($rank != 'viewer') {

                        $html .= '<li class="nav-item '.$configuracio.'">';
                            $html .= '<a class="nav-link" href="/configuracio">';
                                $html .= '<i class="material-icons">settings</i>';
                                $html .= '<p>Configuració</p>';
                            $html .= '</a>';
                        $html .= '</li>';

                    }

                    $html .= '<li class="nav-item '.$seguretat.'">';
                        $html .= '<a class="nav-link" href="/seguretat">';
                            $html .= '<i class="material-icons">security</i>';
                            $html .= '<p>Seguretat</p>';
                        $html .= '</a>';
                    $html .= '</li>';
                    $html .= '<li class="nav-item '.$administracio.'">';
                        $html .= '<a class="nav-link" href="/admin">';
                            $html .= '<i class="material-icons">admin_panel_settings</i>';
                            $html .= '<p>Administració</p>';
                        $html .= '</a>';
                    $html .= '</li>';
                    $html .= '<li class="nav-item active-pro">';
                        $html .= '<a class="nav-link" href="/login/logout.php">';
                            $html .= '<i class="material-icons">exit_to_app</i>';
                            $html .= '<p>Sortir</p>';
                        $html .= '</a>';
                    $html .= '</li>';
                $html .= '</ul>';
            $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    public function Footerlinks() {

        //<!--   Core JS Files   -->
        $html = '<script src="../assets/js/core/popper.min.js"></script>';
        $html .= '<script src="../assets/js/core/bootstrap-material-design.min.js"></script>';
        $html .= '<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>';
        //<!-- Plugin for the momentJs  -->
        $html .= '<script src="../assets/js/plugins/moment.min.js"></script>';
        //<!--  Plugin for Sweet Alert -->
        $html .= '<script src="../assets/js/plugins/sweetalert2.js"></script>';
        //<!-- Forms Validations Plugin -->
        $html .= '<script src="../assets/js/plugins/jquery.validate.min.js"></script>';
        //<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        $html .= '<script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>';
        //<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        $html .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">';
        $html .= '<script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>';
        //<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        $html .= '<script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>';
        //<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        $html .= '<script src="../assets/js/plugins/jquery.dataTables.min.js"></script>';
        //<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        $html .= '<script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>';
        //<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        $html .= '<script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>';
        //<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        $html .= '<script src="../assets/js/plugins/jquery-jvectormap.js"></script>';
        //<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        $html .= '<script src="../assets/js/plugins/nouislider.min.js"></script>';
        //<!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        $html .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>';
        //<!-- Library for adding dinamically elements -->
        $html .= '<script src="../assets/js/plugins/arrive.min.js"></script>';
        //<!-- Chartist JS -->
        $html .= '<script src="../assets/js/plugins/chartist.min.js"></script>';
        //<!--  Notifications Plugin    -->
        $html .= '<script src="../assets/js/plugins/bootstrap-notify.js"></script>';
        //<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        $html .= '<script src="../assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>';
    
        return $html;
    }

}

class Security {

    public function Logintime($redirect) {

        if (isset($_SESSION["user_id"])) {
            if(time()-$_SESSION["login_time"] > 43200) {
                session_unset();
                session_destroy(); 
                header("Location: /login?r=expired&url=".$redirect);
                die();
            }
        } else {
            header("Location: /login?r=notlogged");
            die();
        }
    }

}

class TableArray {

    public function ArrayMonth() {
        
        $meses = array(
            "Juny" => array(6, 2020),
            "Juliol" => array(7, 2020),
            "Agost" => array(8, 2020), 
            "Setembre" => array(9, 2020), 
            "Octubre" => array(10, 2020),
            "Novembre" => array(11, 2020), 
            "Decembre" => array(12, 2020), 
            "Gener" => array(1, 2021), 
            "Febrer" => array(2, 2021), 
            "Març" => array(3, 2021)
        );

        return $meses;
    }

}

class DatabaseConn {

    public function Connection() {

        if ($_SERVER[HTTP_HOST] == 'kreatings.xaviete.com') {

            //Production db kreatings
            $conn = mysqli_connect("db5001646814.hosting-data.io", "dbu1060335", "Ionos123!", "dbs1366328");

        } elseif ($_SERVER[HTTP_HOST] == 'cursos.xaviete.com') {

            //Production db cursos
            $conn = mysqli_connect("db5001782897.hosting-data.io", "dbu422968", "Ionos123!", "dbs1470474");

        } elseif ($_SERVER[HTTP_HOST] == 'dev1.xaviete.com') {

            //Testing db dev1
            $conn = mysqli_connect("db5001760087.hosting-data.io", "dbu936917", "Ionos123!", "dbs1451767");

        } elseif ($_SERVER[HTTP_HOST] == 'dev2.xaviete.com') {

            //Testing db dev2
            $conn = mysqli_connect("db5001760104.hosting-data.io", "dbu1532023", "Ionos123!", "dbs1451782");

        }

        return $conn;
    }

    public function ConnectionPDO() {

        if ($_SERVER[HTTP_HOST] == 'kreatings.xaviete.com') {

            //Production server
            $pdo=new PDO("mysql:dbname=dbs1366328;host=db5001646814.hosting-data.io","dbu1060335","Ionos123!");

        } elseif ($_SERVER[HTTP_HOST] == 'cursos.xaviete.com') {

            //Production db cursos
            $pdo=new PDO("mysql:dbname=dbs1470474;host=db5001782897.hosting-data.io","dbu422968","Ionos123!");

        } elseif ($_SERVER[HTTP_HOST] == 'dev1.xaviete.com') {

            //Testing db dev1
            $pdo=new PDO("mysql:dbname=dbs1451767;host=db5001760087.hosting-data.io","dbu936917","Ionos123!");

        } elseif ($_SERVER[HTTP_HOST] == 'dev2.xaviete.com') {

            //Testing db dev2
            $pdo=new PDO("mysql:dbname=dbs1451782;host=db5001760104.hosting-data.io","dbu1532023","Ionos123!");
        }

        return $pdo;
    }
}



?>