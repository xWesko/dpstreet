<?php
include "conection.php";
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
<!DOCTYPE html>
<html lang="en">

<head>
<title>GamerShop - reportes de ventas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="shortcut icon" href="../../configuraciones/imagen/Joystick.ico">     
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            body
            {
                
                margin:0;
                padding:0;
                background-color:white;
            }
            .box
            {
                width:1270px;
                padding:20px;
                background-color:#fff;
                border:1px solid #ccc;
                border-radius:5px;
                margin-top:25px;
            }
        </style>
    </head>
    <body>
</style>

</style>
  <title>Reportes</title>
</head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-lg-12">
             <a class="btn btn-success" id="export-btn">Export to Excel</a>
<?php

$users = $con->query("

select producto,count(ventas.id_producto) as veces, if(isnull(sum(cantidad)),'0',sum(cantidad))as piezas, if(isnull(sum(total)),'0.00',sum(total)) as monto from productos left join ventas on ventas.id_producto= productos.id_producto group by producto order by monto desc

    ");
?>
<div class="panel panel-warning filterable">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Sales per product</h1>
                
            </div>
<table class="table">
    <thead>
        <tr class="filters">
                  <th>product</th>
                  <th>times</th>
                  <th>pieces</th>
                  <th>Rode</th>
        </tr>
    </thead>
<?php 
while($r=$users->fetch_object()):?>
<tr>
    <td><?php echo $r->producto;?></td>
    <td><?php echo $r->veces;?></td>
    <td><?php echo $r->piezas;?></td>
    <td><?php echo $r->monto;?></td>
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
<!DOCTYPE html>
<html lang="en">

<head>
<title>DPSTREET - reportes de ventas</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <link rel="shortcut icon" href="../../configuraciones/imagen/Joystick.ico">     
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <style>
            body
            {
                
                margin:0;
                padding:0;
                background-color:white;
            }
            .box
            {
                width:1270px;
                padding:20px;
                background-color:#fff;
                border:1px solid #ccc;
                border-radius:5px;
                margin-top:25px;
            }
        </style>
    </head>
    <body>
</style>

</style>
  <title>Reportes</title>
</head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-lg-12">
            <a class="btn btn-success" id="export-btn">Exportar a Excel</a>
<?php

$users = $con->query("

select producto,count(ventas.id_producto) as veces, if(isnull(sum(cantidad)),'0',sum(cantidad))as piezas, if(isnull(sum(total)),'0.00',sum(total)) as monto from productos left join ventas on ventas.id_producto= productos.id_producto group by producto order by monto desc

    ");
?>
<div class="panel panel-warning filterable">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Totales por Producto</h1>
                
            </div>
<table class="table">
    <thead>
        <tr class="filters">
                  <th>producto</th>
                  <th>Veces</th>
                  <th>Piezas</th>
                  <th>Monto</th>
        </tr>
    </thead>
<?php 
while($r=$users->fetch_object()):?>
<tr>
    <td><?php echo $r->producto;?></td>
    <td><?php echo $r->veces;?></td>
    <td><?php echo $r->piezas;?></td>
    <td><?php echo $r->monto;?></td>
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


        
            
                        
                

