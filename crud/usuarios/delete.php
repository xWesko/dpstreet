<?php

include('./db.php');
include("function.php");

if(isset($_POST["id_usuario"]))
{
	$statement = $connection->prepare(
		"DELETE FROM usuarios WHERE id_usuario = :id_usuario"
	);
	$result = $statement->execute(
		array(
			':id_usuario'	=>	$_POST["id_usuario"]
		)
	);
	
	
}



?>