<?php
include_once 'config_sesion.php';
?>

<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    body{
      background-color: black;
    }
  </style>>
    <meta charset="utf-8">
	<title>Ingreso</title>
  <!-- hoja de estilo de materialize (hoja que mantiene los componentes primarios) -->
	<link rel="stylesheet" href="css/materialize.min.css">
  <!-- este link es para poner el icono en la pestaña de la pagina -->
  <link rel="shortcut icon" href="configuraciones/imagen/aaa.png">
  <!-- fuentes de google (fuentes de letras online de google) -->
    <!-- hoja de estilo principal (propiedades de la imagen de fondo) -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<font color="white">DPSTREET</font>


<div class="container-login center-align">
          <div class="card white">
          	<br>
              <span class="card-title"><font color="black">Inicio de Sesion</font></span>
              <br>
              <br>
              	<form action="index.php" method="post">
            <div class="input-field col s6 teal-text">
             
               <input id="icon_prefix" type="text" class="validate" name="usuario" required autofocus value="">
               <label for="icon_prefix"><font color="black">Usuario</font></label>
            </div>
          <div class="input-field col s8 teal-text">
             
             <input id="icon_telephone" type="password" class="validate" name="password" required value="">
             <label for="icon_telephone"><font color="black">Contraseña</font></label>
          </div>
          <br>
            <button class="btn waves-effect waves-light green" class="center-align" type="submit" name="action">Entrar
            <i class="material-icons right"></i>
            </button>
            <input style="visibility: hidden" type="hidden" name="contador"  value="<?php echo $contador;?>"/>
            <p>
          </form>
          <br>
      </div>
    <!-- <div class="card">
      <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="configuraciones/imagen/1279.jpg" width="250" height="300">
      </div>
    <div class="card-content">
    <span class="card-title activator grey-text text-darken-4">Iniciar Sesion<i class="material-icons right">more_vert</i></span>
    </div>
        <div class="card-reveal black">
          <form action="index.php" method="post">
            <span class="card-title white-text">Ingreso<i class="material-icons right">close</i></span>
            <br>
            <div class="input-field col s6 teal-text">
               <i class="material-icons prefix">account_circle</i>
               <input id="icon_prefix" type="text" class="validate" name="cuenta" required autofocus value="">
               <label for="icon_prefix"><font color="white">Usuario</font></label>
            </div>
          <div class="input-field col s6 teal-text">
             <i class="material-icons prefix">vpn_key</i>
             <input id="icon_telephone" type="password" class="validate" name="contrase" required value="">
             <label for="icon_telephone"><font color="white">Contraseña</font></label>
          </div>
          <br>
          <br>
            <button class="btn waves-effect waves-light purple darken-1" type="submit" name="action">Acceder
            <i class="material-icons right">play_arrow</i>
            </button>
            <input style="visibility: hidden" type="hidden" name="contador"  value="<?php echo $contador;?>"/>
            <p>
          </form>
        </div>
    </div> -->
</div>
  <!-- propiedad de las funciones de jquery -->
      <script src="js/jquery.js"></script>
      <script src="js/materialize.min.js"></script>
      <!-- permite que el formato del fondo permanezca exacto y ajustable -->
      <!-- <script src="js/index.js"></script>
      <script src="static/js/jquery-3.2.1.min.js"></script>
      <script src="static/js/bootstrap.js"></script> -->
</body>
</html>