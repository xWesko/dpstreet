<?php
include 'db.php';
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
<title>javi's autos - reportes de ventas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="shortcut icon" href="../../configuraciones/imagen/javisautos.PNG">   
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
      
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
    <!DOCTYPE html>
<html lang="en">
<head>
  <title>DPSTREET</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    body
      {
        
        margin:0;
        padding:0;
        background-color:white;
      }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/dpstreet1/menu1.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="/dpstreet1/Reportes/usuarios/reporteusuarios">Reports Users</a></li>
      <li class=""><a href="/dpstreet1/Reportes/Productos/reporteproductos">Products Report</a></li>
      <li class=""><a href="/dpstreet1/Reportes/clientes/reporteclientes">Customer Report</a></li>
       <li class="active"><a href="/dpstreet1/Reportes/Ventas/reporteventas">Sales Report</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="input-group">
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>
    <title>Reporte ventas </title>
     </head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-lg-12">
             <a class="btn btn-success" id="export-btn">Export Excel</a>

    <!-- Navigation -->
<div class="container">
<br></div><br>
          <table class="table table-bordered" style="background-color:white;margin-left:50px;" >
            <thead>
              <tr>
              <th>ID</th>
            <th>
date of sale</th>
          <th>Usser</th>
                <th>Product</th>
                <th>Client</th>
                <th>
quantity</th>
                <th>
total</th>
               
                
               
              </tr>
            </thead>
            <tbody>      
        <?php
          
           $statement = $connection->prepare("SELECT t1.id_venta,t1.fecha,t1.cliente,t1.usuario,t1.id_producto,t1.total,t1.cantidad
from
(
SELECT v.id_venta,v.fecha,v.id_cliente,v.id_usuario,v.id_producto,v.total,v.cantidad,concat(c.cliente,' ',c.ap_cliente,' ',c.am_cliente) as cliente,u.usuario
from
clientes c
inner join
ventas v
on
c.id_cliente=v.id_cliente 
inner join
usuarios u
on
u.id_usuario=v.id_usuario group by v.id_venta)as t1 ");

          $statement->execute();

          
          while($row=$statement->fetch(PDO::FETCH_ASSOC))
          {
            extract($row);

            echo "<TR>";
                            
            echo "<TD>{$id_venta}</TD>";

            echo "<TD>{$fecha}</TD>";

            echo "<TD>{$cliente}</TD>";
        
       
      echo "<TD>{$usuario}</TD>";
      echo "<TD>{$id_producto}</TD>";
        
      echo "<TD>{$total}</TD>";

      
      echo "<TD>{$cantidad}</TD>";
        
      echo "</TR>";

      }
          ?>
          </tbody>
      </table>


  <script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
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
      <a class="navbar-brand" href="/dpstreet1/menu1.php">Inicio</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="/dpstreet1/Reportes/usuarios/reporteusuarios">Reportes Usuarios</a></li>
      <li class=""><a href="/dpstreet1/Reportes/Productos/reporteproductos">Reporte Productos</a></li>
      <li class=""><a href="/dpstreet1/Reportes/clientes/reporteclientes">Reporte Clientes</a></li>
       <li class="active"><a href="/dpstreet1/Reportes/ventas/reporteventas">Reporte Ventas</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="input-group">
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>

<div class="container">
  
</div>

</body>
</html>

<?php
include 'db.php';
?>

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
    <title>Reporte ventas </title>
    </head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-lg-12">
             <a class="btn btn-success" id="export-btn">Exportar a Excel</a>

    <!-- Navigation -->
<div class="container">
<br></div><br>
          <table class="table table-bordered" style="background-color:white;margin-left:10px;" >
            <thead>
              <tr>
              <th>ID</th>
            <th>Fecha</th>
				  <th>Cliente</th>
                <th>Usuario</th>
                <th>Producto</th>
                 <th>Total</th>
                   <th>Cantidad</th>
                
                
               
              </tr>
            </thead>
            <tbody>      
        <?php
          
          $statement = $connection->prepare("SELECT t1.id_venta,t1.fecha,t1.cliente,t1.usuario,t1.id_producto,t1.total,t1.cantidad
from
(
SELECT v.id_venta,v.fecha,v.id_cliente,v.id_usuario,v.id_producto,v.total,v.cantidad,concat(c.cliente,' ',c.ap_cliente,' ',c.am_cliente) as cliente,u.usuario
from
clientes c
inner join
ventas v
on
c.id_cliente=v.id_cliente 
inner join
usuarios u
on
u.id_usuario=v.id_usuario group by v.id_venta)as t1 ");

          $statement->execute();

          
          while($row=$statement->fetch(PDO::FETCH_ASSOC))
          {
            extract($row);

            echo "<TR>";
                            
            echo "<TD>{$id_venta}</TD>";

            echo "<TD>{$fecha}</TD>";

            echo "<TD>{$cliente}</TD>";
			  
		   
			echo "<TD>{$usuario}</TD>";
			echo "<TD>{$id_producto}</TD>";
		    
			echo "<TD>{$total}</TD>";

			
			echo "<TD>{$cantidad}</TD>";
			  
			echo "</TR>";

 		  }
          ?>
          </tbody>
      </table>


  <script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>

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
