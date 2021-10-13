<?php
include('./db.php');
include('function.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$statement = $connection->prepare("
			INSERT INTO usuarios 
			VALUES (null, :usuario, :cuenta, :password, :nivel, :idioma)
		");
		$result = $statement->execute(
			array(
				':usuario'	=>	$_POST["usuario"],
				':cuenta'	=>	$_POST["cuenta"],
				':password'	=>	md5($_POST["password"]),
				':nivel'	=>	$_POST["nivel"],
				':idioma'	=>	$_POST["idioma"]
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
			"UPDATE usuarios SET usuario = :usuario, cuenta = :cuenta, password = :password, nivel = :nivel, idioma = :idioma WHERE id_usuario = :id_usuario"
		);
		$result = $statement->execute(
			array(
				':usuario'	=>	$_POST["usuario"],
				':cuenta'	=>	$_POST["cuenta"],
				':password'	=>	$_POST["password"],
				':nivel'	=>	$_POST["nivel"],
				':idioma'	=>	$_POST["idioma"],
				':id_usuario'	=>	$_POST["id_usuario"]
			)
		);
		if(!empty($result))
		{
			echo 'Datos Actualizados';
		}
	}
}

?>