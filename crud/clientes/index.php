<?php
session_start();
if ($_SESSION["idioma"]==2){
if(!isset($_SESSION['cuenta'])){
 echo "<script>location.href='index.php'</script>";
}
date_default_timezone_set('America/Hermosillo');
?>
<html>
	<head>
		<title>DPSTREET - Clientes</title>
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
			<h1 align="center">Customers</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">New Client
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="10%">Client</th>
							<th width="20%">Last Name</th>
							<th width="15%">Mother Last Name</th>
							<th width="15%">Phone</th>
							<th width="20%">Email</th>
							<th width="16%">Accion</th>
							
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">New client</h4>
				</div>
				<div class="modal-body">
					<label>Name Client</label>
					<input type="text" onkeypress="return soloLetras(event);" name="cliente" id="cliente" class="form-control" />
					<br />
					<label>Last Name</label>
					<input type="text" onkeypress="return soloLetras(event);" name="ap_cliente" id="ap_cliente" class="form-control" />
					<br />
					<label>Mother Last Name</label>
					<input type="text" onkeypress="return soloLetras(event);" name="am_cliente" id="am_cliente" class="form-control" />
					<br />
					
					<label>Phone</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="telefono" id="telefono" class="form-control" />
					<br />
					<label>Email</label>
					<input type="email" name="email" id="email" class="form-control" />
					<br />
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_cliente" id="id_cliente" />
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
		$('.modal-title').text("Add client");
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
		var cliente = $('#cliente').val();
		var ap_cliente = $('#ap_cliente').val();
		var am_cliente = $('#am_cliente').val();
		var telefono = $('#telefono').val();
		var email = $('#email').val();
		if( cliente != '' && ap_cliente != '' && am_cliente != '' && telefono != '' && email != '')
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
		var id_cliente = $(this).attr("id_cliente");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_cliente:id_cliente},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#cliente').val(data.cliente);
				$('#ap_cliente').val(data.ap_cliente);
				$('#am_cliente').val(data.am_cliente);
				$('#telefono').val(data.telefono);
				$('#email').val(data.email);
				$('.modal-title').text("Edit Client");
				$('#id_cliente').val(id_cliente);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_cliente = $(this).attr("id_cliente");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_cliente:id_cliente},
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
        var valor = document.getElementById("telefono").value;
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
<?php } else { ?>
<html>
	<head>
		<title>DPSTREET - Clientes</title>
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
			<h1 align="center">Clientes</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Nuevo Cliente
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="5%">ID</th>
							<th width="10%">Cliente</th>
							<th width="20%">apellido paterno</th>
							<th width="15%">apellido materno</th>
							<th width="15%">Teléfono</th>
							<th width="20%">Email</th>
							<th width="16%">Accion</th>
							
						</tr>
					</thead>
				</table>
				
			</div>
		</div>
	</body>
</html>

<div id="userModal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="user_form" enctype="multipart/form-data">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Nuevo Cliente</h4>
				</div>
				<div class="modal-body">
					<label>Nombre del Cliente</label>
					<input type="text" onkeypress="return soloLetras(event);" name="cliente" id="cliente" class="form-control" />
					<br />
					<label>Apellido paterno</label>
					<input type="text" onkeypress="return soloLetras(event);" name="ap_cliente" id="ap_cliente" class="form-control" />
					<br />
					<label>Apeliido Materno</label>
					<input type="text" onkeypress="return soloLetras(event);" name="am_cliente" id="am_cliente" class="form-control" />
					<br />
					
					<label>Teléfono</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="telefono" id="telefono" class="form-control" />
					<br />
					<label>Email</label>
					<input type="email" name="email" id="email" class="form-control" />
					<br />
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_cliente" id="id_cliente" />
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
		$('.modal-title').text("Agregar cliente");
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
		var cliente = $('#cliente').val();
		var ap_cliente = $('#ap_cliente').val();
		var am_cliente = $('#am_cliente').val();
		var telefono = $('#telefono').val();
		var email = $('#email').val();
		if( cliente != '' && ap_cliente != '' && am_cliente != '' && telefono != '' && email != '')
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
		var id_cliente = $(this).attr("id_cliente");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_cliente:id_cliente},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#cliente').val(data.cliente);
				$('#ap_cliente').val(data.ap_cliente);
				$('#am_cliente').val(data.am_cliente);
				$('#telefono').val(data.telefono);
				$('#email').val(data.email);
				$('.modal-title').text("Edit User");
				$('#id_cliente').val(id_cliente);
				$('#action').val("Editar");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_cliente = $(this).attr("id_cliente");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_cliente:id_cliente},
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
        var valor = document.getElementById("telefono").value;
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
<?php } ?>