<?php

include('db.php');
include("function.php");

if(isset($_POST["id_cliente"]))
{
	$statement = $connection->prepare(
		"DELETE FROM clientes WHERE id_cliente = :id_cliente"
	);
	$result = $statement->execute(
		array(
			':id_cliente'	=>	$_POST["id_cliente"]
		)
	);
	
	
}



?>