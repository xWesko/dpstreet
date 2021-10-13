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
		<title>DPSTREET - Usuarios</title>
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
			<h1 align="center">Users</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">New User
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="9%">ID</th>
							<th width="20%">User</th>
							<th width="20%">Account</th>
							<th width="20%">Password</th>
							<th width="10%">Lenguage</th>
							<th width="5%">Level</th>
							<th width="15%">Accion</th>
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
					<h4 class="modal-title">New user</h4>
				</div>
				<div class="modal-body">
					<label>user name</label>
					<input type="text" onkeypress="return soloLetras(event);" name="usuario" id="usuario" class="form-control" />
					<br />
					<label>Account</label>
					<input type="email" name="cuenta" id="cuenta" class="form-control" />
					<br />
					<label>password</label>
					<input type="text"  name="password" id="password" class="form-control" />
					<br />
						
			    	<label>Level</label>
			   		 	<select class="form-control" name="nivel" id="nivel">
			        		<option value="2">User</option>
			        		<option value="1">Manager</option>
			        	</select>

			        	<label>Lenguage</label>
			   		 	<select class="form-control" name="idioma" id="idioma">
			        		<option value="1">Spanish</option>
			        		<option value="2">English</option>
			        	</select>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_usuario" id="id_usuario" />
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
		$('.modal-title').text("Add User");
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
		var usuario = $('#usuario').val();
		var cuenta = $('#cuenta').val();
		var password = $('#password').val();
		var nivel = $('#nivel').val();
		var idioma = $('#idioma').val();
		if( usuario != '' && cuenta != '' && password != '' && nivel != '' && idioma != '')
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
		var id_usuario = $(this).attr("id_usuario");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_usuario:id_usuario},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#usuario').val(data.usuario);
				$('#cuenta').val(data.cuenta);
				$('#password').val(data.password);
				$('#nivel').val(data.nivel);
				$('#idioma').val(data.idioma);
				$('.modal-title').text("Edit User");
				$('#id_usuario').val(id_usuario);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_usuario = $(this).attr("id_usuario");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_usuario:id_usuario},
				success:function(data)
				{
					
					dataTable.ajax.reload();
				}
			});
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
        var valor = document.getElementById("").value;
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
  var user = document.getElementById("usuario").value;
  if(user == ""){
   alert("Porfavor escriba un usuario.");
   window.location="#.php";
  }
}
</script>
<?php } else { ?>
<html>
	<head>
		<title>DPSTREET - Usuarios</title>
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
			<h1 align="center">Usuarios</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Nuevo Usuario
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="9%">ID</th>
							<th width="20%">Usuario</th>
							<th width="20%">Cuenta</th>
							<th width="20%">Clave</th>
							<th width="10%">Idioma</th>
							<th width="5%">Nivel</th>
							<th width="15%">Accion</th>
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
					<h4 class="modal-title">Nuevo Usuario</h4>
				</div>
				<div class="modal-body">
					<label>Nombre del Usuario</label>
					<input type="text" onkeypress="return soloLetras(event);" name="usuario" id="usuario" class="form-control" />
					<br />
					<label>Cuenta</label>
					<input type="email" name="cuenta" id="cuenta" class="form-control" />
					<br />
					<label>password</label>
					<input type="text"  name="password" id="password" class="form-control" />
					<br />
						
			    	<label>Nivel</label>
			   		 	<select class="form-control" name="nivel" id="nivel">
			        		<option value="2">Usuario</option>
			        		<option value="1">Administrador</option>
			        	</select>

			        	<label>idioma</label>
			   		 	<select class="form-control" name="idioma" id="idioma">
			        		<option value="1">Español</option>
			        		<option value="2">Ingles</option>
			        	</select>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_usuario" id="id_usuario" />
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
		$('.modal-title').text("Agregar Usuario");
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
		var usuario = $('#usuario').val();
		var cuenta = $('#cuenta').val();
		var password = $('#password').val();
		var nivel = $('#nivel').val();
		var idioma = $('#idioma').val();
		if( usuario != '' && cuenta != '' && password != '' && nivel != '' && idioma != '')
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
		var id_usuario = $(this).attr("id_usuario");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_usuario:id_usuario},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#usuario').val(data.usuario);
				$('#cuenta').val(data.cuenta);
				$('#password').val(data.password);
				$('#nivel').val(data.nivel);
				$('#idioma').val(data.idioma);
				$('.modal-title').text("Edit User");
				$('#id_usuario').val(id_usuario);
				$('#action').val("Editar");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_usuario = $(this).attr("id_usuario");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_usuario:id_usuario},
				success:function(data)
				{
					
					dataTable.ajax.reload();
				}
			});
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
        var valor = document.getElementById("").value;
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
  var user = document.getElementById("usuario").value;
  if(user == ""){
   alert("Porfavor escriba un usuario.");
   window.location="#.php";
  }
}
</script>
<?php } ?>