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
      <a class="navbar-brand" href="/dpstreet1/menu1.php">Home</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="/dpstreet1/Reportes/usuarios/reporteusuarios">Reports Users</a></li>
      <li class=""><a href="/dpstreet1/Reportes/Productos/reporteproductos">Products Report</a></li>
      <li class="active"><a href="/dpstreet1/Reportes/clientes/reporteclientes">Customer Report</a></li>
       <li class=""><a href="/dpstreet1/Reportes/Ventas/reporteventas">Sales Report</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="input-group">
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>


<?php
include './db.php';
?>';

<!DOCTYPE html>
<html lang="en">

<head>
   <li><a href="/dpstreet1/Reportes/clientes/reporteexcel5.php" button class="btn btn-success navbar-btn" class="center-align" type="submit" name="action">Export to Excel</a></li>
<title>DPSTREET - reportes usuarios</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>   
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


          <table class="table table-bordered" style="background-color:white;margin-left:50px;" >
            <thead>
              <tr>
              <th>Id</th>
                <th>Client</th>
                <th>last name</th>
                <th>mother's last name</th>
                <th>Phone</th>
                <th>email</th>
              </tr>
            </thead>
            <tbody>      
        <?php
          
           $statement = $connection->prepare("SELECT id_cliente,cliente,ap_cliente,am_cliente,telefono,email FROM clientes  order by id_cliente DESC"); 
          $statement->execute();
          
          while($row=$statement->fetch(PDO::FETCH_ASSOC))
          {
            extract($row);

           
            echo "<TR>";
            echo "<TD>{$id_cliente}</TD>";
            echo "<TD>{$cliente}</TD>";
            echo "<TD>{$ap_cliente}</TD>";
            echo "<TD>{$am_cliente}</TD>";
            echo "<TD>{$telefono}</TD>";
            echo "<TD>{$email}</TD>";
            
            
           
            echo "</TR>";
          }
          ?>
          </tbody>
      </table>
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
      <li class="active"><a href="/dpstreet1/Reportes/clientes/reporteclientes">Reporte Clientes</a></li>
       <li class=""><a href="/dpstreet1/Reportes/Ventas/reporteventas">Reporte Ventas</a></li>
    </ul>
    <form class="navbar-form navbar-left" action="/action_page.php">
      <div class="input-group">
          </button>
        </div>
      </div>
    </form>
  </div>
</nav>


<?php
include './db.php';
?>';

<!DOCTYPE html>
<html lang="en">

<head>
<title>DPSTREET - reportes usuarios</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
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

     <title>Reportes</title>
</head>
<body>
<div class="container">
    <div class="row ">
        <div class="col-lg-12">
             <a class="btn btn-success" id="export-btn">Exportar a Excel</a>


          <table class="table table-bordered" style="background-color:white;margin-left:50px;" >
            <thead>
              <tr>
              <th>Id</th>
                <th>Cliente</th>
                <th>apellido paterno</th>
                <th>apellido materno</th>
                <th>telefono</th>
                <th>email</th>
              </tr>
            </thead>
            <tbody>      
        <?php
          
           $statement = $connection->prepare("SELECT id_cliente,cliente,ap_cliente,am_cliente,telefono,email FROM clientes  order by id_cliente DESC"); 
          $statement->execute();
          
          while($row=$statement->fetch(PDO::FETCH_ASSOC))
          {
            extract($row);

           
            echo "<TR>";
            echo "<TD>{$id_cliente}</TD>";
            echo "<TD>{$cliente}</TD>";
            echo "<TD>{$ap_cliente}</TD>";
            echo "<TD>{$am_cliente}</TD>";
            echo "<TD>{$telefono}</TD>";
            echo "<TD>{$email}</TD>";
            
            
           
            echo "</TR>";
          }
          ?>
          </tbody>
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
