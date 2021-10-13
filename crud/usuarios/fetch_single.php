<?php
include('./db.php');
include('function.php');
if(isset($_POST["id_usuario"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM usuarios WHERE id_usuario = '".$_POST["id_usuario"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["usuario"] = $row["usuario"];
		$output["cuenta"] = $row["cuenta"];
		$output["password"] = $row["password"];
		$output["nivel"] = $row["nivel"];
		$output["idioma"] = $row["idioma"];
	}
	echo json_encode($output);
}
?>