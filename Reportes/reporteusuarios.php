<?php
include './db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>javi's autos- reportes usuarios</title>
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
				background-color:#42ABEF;
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
    <title>Reporte Usuarios</title>

    <!-- Navigation -->
<div class="container">

            <br>
          <table class="table table-bordered" style="background-color:white;margin-left:50px;" >
            <thead>
              <tr>
              <th>Id</th>
            
                
                <th>usuario</th>
				  <th>cuenta</th>
                <th>password</th>
                <th>nivel</th>
               <th>idioma</th>
               
                
               
              </tr>
            </thead>
            <tbody>      
        <?php
         
          $statement = $connection->prepare("SELECT id_usuario,usuario,cuenta,password,nivel,idioma FROM usuarios order by id_usuario DESC"); 
          $statement->execute();
          
          while($row=$statement->fetch(PDO::FETCH_ASSOC))
          {
            extract($row);

           
            echo "<TR>";
            echo "<TD>{$id_usuario}</TD>";
			echo "<TD>{$usuario}</TD>";
            echo "<TD>{$cuenta}</TD>";
            echo "<TD>{$password}</TD>";

if($nivel == 1){
  $nivell='Administrador';
}
if($nivel == 2){
  $nivell='Supervisor';
}
if($nivel == 2){
  $nivell='Empleado';
}
 echo "<TD>{$nivell}</TD>";
 
if($idioma == 1){
  $idiomaa='Español';
}
if($idioma == 2){
  $idiomaa='Ingles';
}
 echo "<TD>{$idiomaa}</TD>";
          }
          ?>
          </tbody>
      </table>
       



    <!-- Script to Activate the Carousel -->
    

</body>
</html>
