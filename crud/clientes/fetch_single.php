<?php
include('db.php');
include('function.php');
if(isset($_POST["id_cliente"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM clientes WHERE id_cliente = '".$_POST["id_cliente"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["cliente"] = $row["cliente"];
		$output["ap_cliente"] = $row["ap_cliente"];
		$output["am_cliente"] = $row["am_cliente"];
		$output["telefono"] = $row["telefono"];
		$output["email"] = $row["email"];
	}
	echo json_encode($output);
}
?>