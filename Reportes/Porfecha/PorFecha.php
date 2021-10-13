<?php
include "conection.php";
date_default_timezone_set('America/Phoenix');
?>
<?php
session_start();
if ($_SESSION["idioma"]==2){
if(!isset($_SESSION['cuenta'])){
 echo "<script>location.href='index.php'</script>";
}
date_default_timezone_set('America/Hermosillo');
?>
<!DOCTYPE html>
<html>
<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../app/css/bootstrap.min.css">
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
            <li><a href="/dpstreet1/menu1.php" button class="btn btn-warning navbar-btn" class="center-align" type="submit" name="action">Home</a></li>

          
        
        </div>
      </div>
    </form>
  </div>
</nav>
  <title>Reports</title>
</head>
<body>
<div class="container">
    <div class="row ">

<?php

if (!isset($_POST["fecha1"])) {
 $_POST["fecha1"]=date('Y-m-d');
 $_POST["fecha2"]=date('Y-m-d');
}
?><br>
    <form action="porfecha.php" method="post">
        <label>
Start date</label>
        <input type="date" name="fecha1" id="fecha1" value="<?php echo $_POST['fecha1']; ?>">
        <label>
Final date</label>
        <input type="date" name="fecha2" id="fecha2" value="<?php echo $_POST['fecha2'];  ?>">
        <input type="submit" name="submit" value="Search">
    </form><br>
     <a class="btn btn-success" id="export-btn">Export to Excel</a>
        <div class="col-lg-12">
<?php
$users = $con->query("
            select ventas.id_producto,producto,fecha,total 
            from ventas,productos 
            where ventas.id_producto = productos.id_producto and 
            fecha>= ".str_replace("-","",$_POST['fecha1'])."000000 and 
            fecha<= ".str_replace("-","",$_POST['fecha2'])."235959 
            order by ventas.id_producto "); 
?>
 <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title text-center">sales per times</h1>
            </div>
<table class="table">
    <thead>
        <tr >
                  <th>ID</th>
                  <th>Product</th>
                  <th>Date</th>
                  <th>Total</th>
        </tr>
    </thead>
<?php
if ($users->num_rows == 0) {
    echo "<tr><td>
no sales</tr></td>";
} 
while($r=$users->fetch_object()):?>
<tr>
    <td><?php echo $r->id_producto;?></td>
    <td><?php echo $r->producto;?></td>
    <td><?php echo $r->fecha;?></td>
    <td><?php echo $r->total;?></td>
</tr>
<?php endwhile; ?>
</table>
<br><br>

        </div>
    </div>
  </div>
<script src="../jquery.table2excel.js"></script>
<script type="text/javascript">
 jQuery(document).ready(function() {    
    $('#export-btn').on('click', function(e){
        e.preventDefault();
        ResultsToTable();
    });
    
    function ResultsToTable(){    
        $(".table").table2excel({
            exclude: ".noExl",
            name: "Results"
        });
    }
});
</script>
</body>
</html>  
<?php } else { ?>
<html>
<head>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="../app/css/bootstrap.min.css">
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
            <li><a href="/dpstreet1/menu1.php" button class="btn btn-warning navbar-btn" class="center-align" type="submit" name="action">Inicio</a></li>

          
        
        </div>
      </div>
    </form>
  </div>
</nav>
  <title>Reportes</title>
</head>
<body>
<div class="container">
    <div class="row ">
<?php

if (!isset($_POST["fecha1"])) {
 $_POST["fecha1"]=date('Y-m-d');
 $_POST["fecha2"]=date('Y-m-d');
}
?><br>
    <form action="porfecha.php" method="post">
        <label>Fecha Inicio</label>
        <input type="date" name="fecha1" id="fecha1" value="<?php echo $_POST['fecha1']; ?>">
        <label>Fecha Final</label>
        <input type="date" name="fecha2" id="fecha2" value="<?php echo $_POST['fecha2'];  ?>">
        <input type="submit" name="submit">
    </form><br>
    <a class="btn btn-success" id="export-btn">Exportar a Excel</a>
        <div class="col-lg-12">
<?php
$users = $con->query("
            select productos.id_producto,producto,fecha,total 
            from ventas,productos 
            where ventas.id_producto = productos.id_producto and 
            fecha>= ".str_replace("-","",$_POST['fecha1'])."000000 and 
            fecha<= ".str_replace("-","",$_POST['fecha2'])."235959 
            order by ventas.id_producto "); 
?>
 <div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Ventas por Fecha</h1>
            </div>
<table class="table">
    <thead>
        <tr >
                  <th>ID</th>
                  <th>Producto</th>
                  <th>Fecha</th>
                  <th>Total</th>
        </tr>
    </thead>
<?php
if ($users->num_rows == 0) {
    echo "<tr><td>No hay Ventas</tr></td>";
} 
while($r=$users->fetch_object()):?>
<tr>
    <td><?php echo $r->id_producto;?></td>
    <td><?php echo $r->producto;?></td>
    <td><?php echo $r->fecha;?></td>
    <td><?php echo $r->total;?></td>
</tr>
<?php endwhile; ?>
</table>
<br><br>

        </div>
    </div>
  </div>
  <script src="../jquery.table2excel.js"></script>
<script type="text/javascript">
 jQuery(document).ready(function() {    
    $('#export-btn').on('click', function(e){
        e.preventDefault();
        ResultsToTable();
    });
    
    function ResultsToTable(){    
        $(".table").table2excel({
            exclude: ".noExl",
            name: "Results"
        });
    }
});
</script>

</body>
</html>  
<?php } ?>

        
            
                        
                

