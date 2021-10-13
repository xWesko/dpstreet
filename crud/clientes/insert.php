<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO clientes 
			VALUES (null, :cliente, :ap_cliente, :am_cliente, :telefono, :email)
		");
		$result = $statement->execute(
			array(
				':cliente'	=>	$_POST["cliente"],
				':ap_cliente'	=>	$_POST["ap_cliente"],
				':am_cliente'	=>	$_POST["am_cliente"],
				':telefono'	=>	$_POST["telefono"],
				':email'	=>	$_POST["email"]
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
			"UPDATE clientes SET cliente = :cliente,ap_cliente= :ap_cliente,am_cliente=:am_cliente ,telefono = :telefono, email = :email WHERE id_cliente = :id_cliente"
		);
		$result = $statement->execute(
			array(
				':cliente'	=>	$_POST["cliente"],
				':ap_cliente'	=>	$_POST["ap_cliente"],
				':am_cliente'	=>	$_POST["am_cliente"],
				':telefono'	=>	$_POST["telefono"],
				':email'	=>	$_POST["email"],
				':id_cliente'	=>	$_POST["id_cliente"]
			)
		);
		if(!empty($result))
		{
			echo 'Datos Actualizados';
		}
	}
}

?>