<?php
session_start();
include('db.php'); 
if(!isset($_SESSION['cuenta'])){
 echo "<script>location.href='../../index.php'</script>";
}
if ($_SESSION["idioma"]==2){
date_default_timezone_set('America/Hermosillo');
?>
<html>
	<head>
		<title>DPSTREET - Ventas</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				
				margin:0;
				padding:0;
				background-color:#000;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
	<?php include('menu.php'); ?>
		<div class="container box">
			<h1 align="center">Sales</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">sales new
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="9%">ID</th>
							<th width="20%">User</th>
							<th width="10%">Client</th>
							<th width="10%">Product</th>
							<th width="10%">Date</th>
							<th width="20%">total</th>
							<th width="10%">Quantity</th>

							<th width="11%">accion</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	
<?php
    $user = $connection->prepare("SELECT * FROM usuarios");
	$user->execute();
	$us = $user->fetchAll();

	$client = $connection->prepare("SELECT * FROM clientes");
	$client->execute();
	$cli = $client->fetchAll();

	$producto = $connection->prepare("SELECT * FROM productos");
	$producto->execute();
	$pro = $producto->fetchAll();
	
	
?>
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">sales new</h4>
				</div>
				<div class="modal-body">
			    		<label for="usuario">User</label>
			   		 	<select class="form-control" name="id_usuario" id="id_usuario" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($us as $u ) {
			        		 ?>
			        		<option value="<?php echo $u['id_usuario']; ?>"><?php echo $u['usuario']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>
			        	<label for="cliente">Client</label>
			   		 	<select class="form-control" name="id_cliente" id="id_cliente" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($cli as $c ) {
			        		 ?>
			        		<option value="<?php echo $c['id_cliente']; ?>"><?php echo $c['cliente']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>

			        			<label for="producto">Product</label>
			   		 	<select class="form-control" name="id_producto" id="id_producto" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($pro as $p ) {
			        		 ?>
			        		<option value="<?php echo $p['id_producto']; ?>"><?php echo $p['producto']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>
					<label>Date</label>
					<input type="date"  name="fecha" id="fecha" class="form-control" />
					<br />
					<label>Total</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="total" id="total" class="form-control" />
					<br />
					<label>Quantity</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="cantidad" id="cantidad" class="form-control" />
					<br />
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_venta" id="id_venta" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Agregar" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Add sales");
		$('#action').val("Add");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var id_usuario = $('#id_usuario').val();
		var id_cliente = $('#id_cliente').val();
		var id_producto = $('#id_producto').val();
		var Fecha = $('#Fecha').val();
		var total = $('#total').val();
		var cantidad = $('#cantidad').val();

		if( id_usuario != '' && id_cliente != '' && id_producto != '' && fecha != '' && total != '' &&cantidad != '' )
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Todos los campos son requeridos");
		}
	});
	
	$(document).on('click', '.update', function(){
		var id_venta = $(this).attr("id_venta");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_venta:id_venta},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#id_usuario').val(data.id_usuario);
				$('#id_cliente').val(data.id_cliente);
				$('#id_producto').val(data.id_producto);
				$('#fecha').val(data.fecha);
				$('#total').val(data.total);
				$('#cantidad').val(data.cantidad);
				$('.modal-title').text("Edit Sales");
				$('#id_venta').val(id_venta);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_venta = $(this).attr("id_venta");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_venta:id_venta},
				success:function(data)
				{
					
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
});
function soloLetras(e) 
      {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        //Se define todo el abecedario que se quiere que se muestre.
        especiales = [8,6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
            
        tecla_especial = false
        for(var i in especiales) {
          if(key == especiales[i]) {
            tecla_especial = true;
            break;
          }
        }
        if(letras.indexOf(tecla) == -1 && !tecla_especial){
          alert('Solo se Acepta Letras');
          return false;
        }
      }
      function soloNumeros(e)
      {
        // capturamos la tecla pulsada
        var teclaPulsada = window.event ? window.event.keyCode:e.which;   
        // capturamos el contenido del input
        var valor = document.getElementById("total").value;
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada == 13 || teclaPulsada == 8 || (teclaPulsada == 46 && valor.indexOf(".") == -1))
        {
          return true;
        }
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
      }
       function validation(){
  var user = document.getElementById("cliente").value;
  if(user == ""){
   alert("Porfavor escriba un cliente.");
   window.location="#.php";
  }
}
</script>
</body>
</html>
<?php } else { ?>
<html>
	<head>
		<title>La Cafetería - Ventas</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<style>
			body
			{
				
				margin:0;
				padding:0;
				background-color:#000;
			}
			.box
			{
				width:1270px;
				padding:20px;
				background-color:#fff;
				border:1px solid #ccc;
				border-radius:5px;
				margin-top:25px;
			}
		</style>
	</head>
	<body>
	<?php include('menu.php'); ?>
		<div class="container box">
			<h1 align="center">Ventas</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Nueva Venta
					</button> 
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="9%">ID</th>
							<th width="20%">Usuario</th>
							<th width="10%">Cliente</th>
							<th width="10%">Producto</th>
							<th width="10%">Fecha</th>
							<th width="20%">total</th>
							<th width="10%">Cantidad</th>

							<th width="11%">accion</th>
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
<?php
    $user = $connection->prepare("SELECT * FROM usuarios");
	$user->execute();
	$us = $user->fetchAll();

	$client = $connection->prepare("SELECT * FROM clientes");
	$client->execute();
	$cli = $client->fetchAll();

	$producto = $connection->prepare("SELECT * FROM productos");
	$producto->execute();
	$pro = $producto->fetchAll();
?>
<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Nueva Venta</h4>
				</div>
				<div class="modal-body">
			    		<label for="usuario">Usuario</label>
			   		 	<select class="form-control" name="id_usuario" id="id_usuario" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($us as $u ) {
			        		 ?>
			        		<option value="<?php echo $u['id_usuario']; ?>"><?php echo $u['usuario']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>
			        	<label for="cliente">Cliente</label>
			   		 	<select class="form-control" name="id_cliente" id="id_cliente" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($cli as $c ) {
			        		 ?>
			        		<option value="<?php echo $c['id_cliente']; ?>"><?php echo $c['cliente']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>

			        			<label for="producto">Producto</label>
			   		 	<select class="form-control" name="id_producto" id="id_producto" required>
			        		<option value="0">Seleccione un valor</option>
			        		<?php foreach ($pro as $p ) {
			        		 ?>
			        		<option value="<?php echo $p['id_producto']; ?>"><?php echo $p['producto']; ?></option>
			        		<?php
			        		 }
			        		 ?>
			        			</select>
					<label>Fecha</label>
					<input type="date"  name="fecha" id="fecha" class="form-control" />
					<br />
					<label>Total a Pagar</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="total" id="total" class="form-control" />
					<br />
					<label>Cantidad</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="cantidad" id="cantidad" class="form-control" />
					<br />
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_venta" id="id_venta" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Agregar" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	$('#add_button').click(function(){
		$('#user_form')[0].reset();
		$('.modal-title').text("Nueva Venta");
		$('#action').val("Agregar");
		$('#operation').val("Add");
	});
	
	var dataTable = $('#user_data').DataTable({
		"processing":true,
		"serverSide":true,
		"order":[],
		"ajax":{
			url:"fetch.php",
			type:"POST"
		},
		"columnDefs":[
			{
				"targets":[0, 3, 4],
				"orderable":false,
			},
		],

	});

	$(document).on('submit', '#user_form', function(event){
		event.preventDefault();
		var id_usuario = $('#id_usuario').val();
		var id_cliente = $('#id_cliente').val();
		var id_producto = $('#id_producto').val();
		var fecha = $('#fecha').val();
		var total = $('#total').val();
		var cantidad = $('#cantidad').val();

		if( id_usuario != '' && id_cliente != '' && id_producto != '' && fecha != '' && total != '' &&cantidad != '' )
		{
			$.ajax({
				url:"insert.php",
				method:'POST',
				data:new FormData(this),
				contentType:false,
				processData:false,
				success:function(data)
				{
					alert(data);
					$('#user_form')[0].reset();
					$('#userModal').modal('hide');
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			alert("Todos los campos son requeridos");
		}
	});
	
	$(document).on('click', '.update', function(){
		var id_venta = $(this).attr("id_venta");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_venta:id_venta},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#id_usuario').val(data.id_usuario);
				$('#id_cliente').val(data.id_cliente);
				$('#id_producto').val(data.id_producto);
				$('#fecha').val(data.fecha);
				$('#total').val(data.total);
				$('#cantidad').val(data.cantidad);
				$('.modal-title').text("Edit User");
				$('#id_venta').val(id_venta);
				$('#action').val("Editar");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_venta = $(this).attr("id_venta");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_venta:id_venta},
				success:function(data)
				{
					
					dataTable.ajax.reload();
				}
			});
		}
		else
		{
			return false;	
		}
	});
	
});
function soloLetras(e) 
      {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toString();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyzÁÉÍÓÚABCDEFGHIJKLMNÑOPQRSTUVWXYZ";
        //Se define todo el abecedario que se quiere que se muestre.
        especiales = [8,6]; //Es la validación del KeyCodes, que teclas recibe el campo de texto.
            
        tecla_especial = false
        for(var i in especiales) {
          if(key == especiales[i]) {
            tecla_especial = true;
            break;
          }
        }
        if(letras.indexOf(tecla) == -1 && !tecla_especial){
          alert('Solo se Acepta Letras');
          return false;
        }
      }
      function soloNumeros(e)
      {
        // capturamos la tecla pulsada
        var teclaPulsada = window.event ? window.event.keyCode:e.which;   
        // capturamos el contenido del input
        var valor = document.getElementById("total").value;
        // 13 = tecla enter
        // 46 = tecla punto (.)
        // Si el usuario pulsa la tecla enter o el punto y no hay ningun otro
        // punto
        if(teclaPulsada == 13 || teclaPulsada == 8 || (teclaPulsada == 46 && valor.indexOf(".") == -1))
        {
          return true;
        }
        // devolvemos true o false dependiendo de si es numerico o no
        return /\d/.test(String.fromCharCode(teclaPulsada));
      }
       function validation(){
  var user = document.getElementById("cliente").value;
  if(user == ""){
   alert("Porfavor escriba un cliente.");
   window.location="#.php";
  }
}
</script>
</body>
</html>
<?php } ?>
