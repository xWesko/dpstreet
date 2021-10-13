<?php

include('./db.php');
include("function.php");

if(isset($_POST["id_venta"]))
{
	$statement = $connection->prepare(
		"DELETE FROM ventas WHERE id_venta = :id_venta"
	);
	$result = $statement->execute(
		array(
			':id_venta'	=>	$_POST["id_venta"]
		)
	);
	
	
}



?>