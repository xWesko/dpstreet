<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM ventas ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE fecha LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_venta DESC ';
}
if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
	$sub_array = array();
	$sub_array[] = $row["id_venta"];
	$sub_array[] = $row["id_usuario"];
	$sub_array[] = $row["id_cliente"];
	$sub_array[] = $row["id_producto"];
	$sub_array[] = $row["fecha"];
	$sub_array[] = $row["total"];
	$sub_array[] = $row["cantidad"];
	$sub_array[] = '<button type="button" name="update" id_venta="'.$row["id_venta"].'" class="btn btn-warning btn-xs update">Update</button> <button type="button" name="delete" id_venta="'.$row["id_venta"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$data[] = $sub_array;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>