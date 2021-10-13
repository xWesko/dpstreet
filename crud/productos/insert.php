<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO productos 
			VALUES (null, :producto, :precio, :marca)
		");
		$result = $statement->execute(
			array(
				':producto'	=>	$_POST["producto"],
				':precio'	=>	$_POST["precio"],
				':marca'	=>	$_POST["marca"]
				)
		);
		if(!empty($result))
		{
			echo 'Registro Exitoso';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$statement = $connection->prepare(
			"UPDATE productos SET producto = :producto, precio= :precio,marca= :marca WHERE id_producto = :id_producto"
		);
		$result = $statement->execute(
			array(
				':producto'	=>	$_POST["producto"],
				':precio'	=>	$_POST["precio"],
				':marca'	=>	$_POST["marca"],
				':id_producto'	=>	$_POST["id_producto"]
			)
		);
		if(!empty($result))
		{
			echo 'Datos Actualizados';
		}
	}
}

?>