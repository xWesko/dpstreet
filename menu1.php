<?php
session_start();
if ($_SESSION["idioma"]==2){
if(!isset($_SESSION['cuenta'])){
 echo "<script>location.href='index.php'</script>";
}
date_default_timezone_set('America/Hermosillo');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DPSTREET</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DPSTREET</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/dpstreet1/crud/usuarios">Cruds</a></li>
      <li><a href="/dpstreet1/Reportes/usuarios/reporteusuarios">basic reports</a></li>
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">compound reports
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/dpstreet1/Reportes/VentasporUsuarios/VentasporUsuarios">sales per user</a></li>
          <li><a href="/dpstreet1/Reportes/VentasporClientes/VentasporClientes">sales per customer</a></li>
          <li><a href="/dpstreet1/Reportes/VentasporProductos/VentasporProductos">sales by product</a></li>
          <li><a href="/dpstreet1/Reportes/Porfecha/PorFecha">by date</a></li>
           <li><a href="/dpstreet1/Reportes/Sumario/Sumario">summary</a></li>
        </ul>
      </li>
     
 
    </ul>
     <li><a href="cerrar.php" button class="btn btn-danger navbar-btn" class="center-align" type="submit" name="action">Sign off</a></li>
  </div>
</nav>
<h2>WELCOME</h2>

  <!-- propiedad de las funciones de jquery -->
      <script src="js/jquery.js"></script>
      <script src="js/materialize.min.js"></script>
</body>
</html>
<?php } else { ?>
<html lang="en">
<head>
  <title>DPSTREET</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">DPSTREET</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/dpstreet1/crud/usuarios">LISTAS</a></li>
     <li><a href="/dpstreet1/Reportes/usuarios/reporteusuarios">Reportes basicos</a></li>
       <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Reportes Compuestos
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="/dpstreet1/Reportes/VentasporUsuarios/VentasporUsuarios">Ventas por Usuario</a></li>
          <li><a href="/dpstreet1/Reportes/VentasporClientes/VentasporClientes">Ventas por Cliente</a></li>
          <li><a href="/dpstreet1/Reportes/VentasporProductos/VentasporProductos">Ventas por Producto</a></li>
          <li><a href="/dpstreet1/Reportes/Porfecha/PorFecha">Por Fecha</a></li>
           <li><a href="/dpstreet1/Reportes/Sumario/Sumario">Sumario</a></li>
        </ul>
      </li>
     
 
    </ul>
    <li class="pull-right"><a href="cerrar.php" button class="btn btn-danger navbar-btn" class="center-align" type="submit" name="action">Cerrar Sesión</a></li>
<li><a href="CONTRASENA/perfil.php" button class="btn btn-warning navbar-btn" class="center-align" type="submit" name="action">Cambiar Contraseña</a></li>
  </div>
</nav>
<h2>BIENVENIDO</h2>

  <!-- propiedad de las funciones de jquery -->
      <script src="js/jquery.js"></script>
      <script src="js/materialize.min.js"></script>
</body>
</html>
<?php } ?>