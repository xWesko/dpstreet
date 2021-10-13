<?php
include('./db.php');
include('function.php');
if(isset($_POST["id_venta"]))
{
	$output = array();
	$statement = $connection->prepare(
		"SELECT * FROM ventas WHERE id_venta = '".$_POST["id_venta"]."' LIMIT 1"
	);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output["id_usuario"] = $row["id_usuario"];
		$output["id_cliente"] = $row["id_cliente"];
		$output["id_producto"] = $row["id_producto"];
		$output["fecha"] = $row["fecha"];
		$output["total"] = $row["total"];
		$output["cantidad"] = $row["cantidad"];
	}
	echo json_encode($output);
}
?>