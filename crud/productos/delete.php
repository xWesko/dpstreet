<?php

include('db.php');
include("function.php");

if(isset($_POST["id_producto"]))
{
	$statement = $connection->prepare(
		"DELETE FROM productos WHERE id_producto = :id_producto"
	);
	$result = $statement->execute(
		array(
			':id_producto'	=>	$_POST["id_producto"]
		)
	);
	
	
}



?>