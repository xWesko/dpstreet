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
        <div class="col-lg-12">
            <a class="btn btn-success" id="export-btn">Export to Excel</a>
<?php

$users = $con->query("SELECT * FROM productos,ventas WHERE productos.id_producto =ventas.id_producto ORDER BY productos.id_producto");
?>
<br>
<div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Sumary</h1>
            </div>
<table class="table" border=1 cellspacing=1 align=center>
    <tbody>
<?php 
$miprod="";
$monto=0;
$piezas=0;
$veces=0;
$tmonto=0;
$tpiezas=0;
$tveces=0;
while($r=$users->fetch_object()):?>
        
    <?php if($miprod != $r->id_producto)
        {
            if ($miprod != "") 
            {
                    echo "<TR><TD> Veces: ".$veces." </TD>";
                    echo "<TD>Totales:</TD><TD>".$piezas."</TD>";
                    echo "<TD>".$monto."</TD><TR>";
                        $tveces = $tveces + $veces;
                        $tpiezas = $tpiezas + $piezas;
                        $tmonto = $tmonto + $monto;
                        $veces = $piezas = $monto = 0;
                    echo "</TBODY></TABLE><br></TD></TR>"; 
            }
            echo "<TR><TD><h4>".$r->id_producto.'   -   '.$r->producto.'    -     '.$r->marca.'     -     '.$r->precio."</h4><BR>";
            echo "<TABLE width ='50%' height='100px' border=1 cellspacing=1 align=center ><TBODY><TR><TH>ID</TH><TH>FECHA</TH><TH>CANTIDAD</TH><TH>TOTAL</TH></TR><TR><TD>".$r->id_venta."</TD><TD>".$r->fecha."</TD><TD>".$r->cantidad."</TD><TD>".$r->total."</TD></TR>";
            $veces++;
            $piezas = $piezas + $r->cantidad;
            $monto = $monto + $r->total;
            $miprod= $r->id_producto;

        }
        else
        {
            echo "<TR><TD>".$r->id_venta."</TD><TD>".$r->fecha."</TD><TD>".$r->cantidad."</TD><TD>".$r->total."</TD></TR>";
            $veces++;
            $piezas = $piezas + $r->cantidad;
            $monto = $monto + $r->total;
        }
 endwhile; 
 echo "<TR><TD> Veces: ".$veces." </TD><TD>Totales:</TD><TD>".$piezas." </TD><TD>".$monto."</TD></TR>";                    
                        $tveces = $tveces + $veces;
                        $tpiezas = $tpiezas + $piezas;
                        $tmonto = $tmonto + $monto;
 ?>
</tbody></table><br></TD><TR>
</tbody><table><h5>
    Total de Veces:<?php echo $tveces; ?><br>
    Total de Piezas:<?php echo $tpiezas; ?>
<br>Monto Total:<?php echo $tmonto; ?><br>
</h5>
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
        <div class="col-lg-12">
          <a class="btn btn-success" id="export-btn">Exportar a Excel</a>
<?php

$users = $con->query("SELECT * FROM productos,ventas WHERE productos.id_producto =ventas.id_producto ORDER BY productos.id_producto");
?>
<br>
<div class="panel">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Sumario</h1>
            </div>
<table class="table" border=1 cellspacing=1 align=center>
    <tbody>
<?php 
$miprod="";
$monto=0;
$piezas=0;
$veces=0;
$tmonto=0;
$tpiezas=0;
$tveces=0;
while($r=$users->fetch_object()):?>
        
    <?php if($miprod != $r->id_producto)
        {
            if ($miprod != "") 
            {
                    echo "<TR><TD> Veces: ".$veces." </TD>";
                    echo "<TD>Totales:</TD><TD>".$piezas."</TD>";
                    echo "<TD>".$monto."</TD><TR>";
                        $tveces = $tveces + $veces;
                        $tpiezas = $tpiezas + $piezas;
                        $tmonto = $tmonto + $monto;
                        $veces = $piezas = $monto = 0;
                    echo "<br></TD></TR>"; 
            }
            echo "<TR><TD><h4>".$r->id_producto.'   -   '.$r->producto.'    -     '.$r->marca.'     -     '.$r->precio."</h4><BR>";
            echo "<TBODY><TR><TH>ID</TH><TH>FECHA</TH><TH>CANTIDAD</TH><TH>TOTAL</TH></TR><TR><TD>".$r->id_venta."</TD><TD>".$r->fecha."</TD><TD>".$r->cantidad."</TD><TD>".$r->total."</TD></TR>";
            $veces++;
            $piezas = $piezas + $r->cantidad;
            $monto = $monto + $r->total;
            $miprod= $r->id_producto;

        }
        else
        {
            echo "<TR><TD>".$r->id_venta."</TD><TD>".$r->fecha."</TD><TD>".$r->cantidad."</TD><TD>".$r->total."</TD></TR>";
            $veces++;
            $piezas = $piezas + $r->cantidad;
            $monto = $monto + $r->total;
        }
 endwhile; 
 echo "<TR><TD> Veces: ".$veces." </TD><TD>Totales:</TD><TD>".$piezas." </TD><TD>".$monto."</TD></TR>";                    
                        $tveces = $tveces + $veces;
                        $tpiezas = $tpiezas + $piezas;
                        $tmonto = $tmonto + $monto;
 ?>
</tbody></table><br></TD><TR>
</tbody><table><h5>
    Total de Veces:<?php echo $tveces; ?><br>
    Total de Piezas:<?php echo $tpiezas; ?>
<br>Monto Total:<?php echo $tmonto; ?><br>
</h5>
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


        
            
                        
                

