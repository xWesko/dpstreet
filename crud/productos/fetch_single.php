<?php
include('db.php');
include('function.php');
if(isset($_POST["id_producto"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM productos WHERE id_producto = '".$_POST["id_producto"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["producto"] = $row["producto"];
		$output["precio"] = $row["precio"];
		$output["marca"] = $row["marca"];
	}
	echo json_encode($output);
}
?>