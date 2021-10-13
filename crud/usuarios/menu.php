<?php
if ($_SESSION["idioma"]==2){
if(!isset($_SESSION['cuenta'])){
 echo "<script>location.href='index.php'</script>";
}
date_default_timezone_set('America/Hermosillo');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>DPSTREET</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- hoja de estilo de materialize (hoja que mantiene los componentes primarios) -->
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="/dpstreet1/menu1.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/dpstreet1/crud/usuarios">users</a></li>
      <li><a href="/dpstreet1/crud/productos">Products</a></li>
      <li><a href="/dpstreet1/crud/ventas">Sales</a></li>
      <li><a href="/dpstreet1/crud/clientes">Customers</a></li>
    </ul>
  </div>
</nav>
</nav>
</head>
</html>
<?php } else { ?>
<html>
<head>
  <meta charset="utf-8">
  <title>DPSTREET</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- hoja de estilo de materialize (hoja que mantiene los componentes primarios) -->
  <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="/dpstreet1/menu1.php">Inicio</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="/dpstreet1/crud/usuarios">Usuarios</a></li>
      <li><a href="/dpstreet1/crud/productos">Productos</a></li>
      <li><a href="/dpstreet1/crud/ventas">Ventas</a></li>
      <li><a href="/dpstreet1/crud/clientes">Clientes</a></li>
    </ul>
  </div>
</nav>
</nav>
</head>
</html>
<?php } ?>