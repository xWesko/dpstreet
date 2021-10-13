<?php
include('./db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM usuarios ";
if(isset($_POST["search"]["value"]))
{
	$query .= 'WHERE usuario LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cuenta LIKE "%'.$_POST["search"]["value"].'%" ';
}
if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_usuario DESC ';
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
	$sub_array[] = $row["id_usuario"];
	$sub_array[] = $row["usuario"];
	$sub_array[] = $row["cuenta"];
	$sub_array[] = $row["password"];
	$sub_array[] = $row["nivel"];
	$sub_array[] = $row["idioma"];
	$sub_array[] = '<button type="button" name="update" id_usuario="'.$row["id_usuario"].'" class="btn btn-warning btn-xs update">Update</button> <button type="button" name="delete" id_usuario="'.$row["id_usuario"].'" class="btn btn-danger btn-xs delete">Delete</button>';
	$sub_array[] = ' ';
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