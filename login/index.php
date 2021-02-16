<?php require_once('../static.php'); 
	$obj = new NavBar();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Header -->
	<?php printf($obj->Head()); ?>

    <script src="login.js"></script>

</head>

<body class="">

    <div class="wrapper">
        <div class="">
      
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-center mt-100">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-header card-header-danger">
                                <h4 class="card-title ">Iniciar sessió</h4>
                                <p class="card-category">Introdueix les teves dades per accedir</p>
                            </div>
                        
                            <div class="card-body">
                                <form class="form-signin" id="login_form" method="POST">
                                    <div class="alert alert-warning display-none" id="session-expired" role="alert">La sessió ha expirat.</div>
                                    <div class="alert alert-warning display-none" id="session-error" role="alert">Usuari i/o contrasenya incorrectes.</div>

                                    <label class="mt-3">Usuari:</label>
                                    <input type="text" class="form-control input-danger" name="username" required="" autofocus="" />

                                    <label class="mt-4">Contrasenya:</label>
                                    <input type="password" class="form-control" name="password" required=""/>  

                                    <button class="btn btn-lg btn-danger btn-block mt-5" id="login_button" type="submit">Entrar</button>
                                </form>
                                
                            <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>