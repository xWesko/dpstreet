<?php
include_once 'config_sesion.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>DPSTREET</title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">DPSTREET</h1>
            <form action="index.php" method="post">
            <div class="account-wall">
                <img class="profile-img" width="360px" src="imagenes/dp.jpg" alt="">
                <form class="form-signin">
                <input type="text" class="form-control" name="cuenta" placeholder="Cuenta" required autofocus>
            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="action">
                    Iniciar Sesión</button>
                    <input style="visibility: hidden" type="hidden" name="contador"  value="<?php echo $contador;?>"/>
        </div>
    </div>
</div>
</body>
</html>