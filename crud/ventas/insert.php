<?php
include('./db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO ventas 
			VALUES (null, :id_usuario, :id_cliente, :id_producto, :fecha, :cantidad, :total)
		");
		$result = $statement->execute(
			array(
				':id_usuario'	=>	$_POST["id_usuario"],
				':id_cliente'	=>	$_POST["id_cliente"],
				':id_producto'	=>	$_POST["id_producto"],
				':fecha'	=>	$_POST["fecha"],
				':cantidad'	=>	$_POST["cantidad"],
				':total'	=>	$_POST["total"]
				

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
			"UPDATE ventas SET id_usuario = :id_usuario, id_cliente = :id_cliente, id_producto = :id_producto, fecha = :fecha,  cantidad = :cantidad, total = :total WHERE id_venta = :id_venta"
		);
		$result = $statement->execute(
			array(
				':id_usuario'	=>	$_POST["id_usuario"],
				':id_cliente'	=>	$_POST["id_cliente"],
				':id_producto'	=>	$_POST["id_producto"],
				':fecha'	=>	$_POST["fecha"],
				':cantidad'	=>	$_POST["cantidad"],
				':total'	=>	$_POST["total"],
				':id_venta'	=>	$_POST["id_venta"]
			)
		);
		if(!empty($result))
		{
			echo 'Datos Actualizados';
		}
	}
}

?>