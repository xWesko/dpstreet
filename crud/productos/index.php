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
		<title>DPSTREET - Productos</title>
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
			<h1 align="center">Products</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">New Product
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="39%">Name Product</th>
							<th width="15%">Price</th>
							<th width="25%">Prand</th>
							<th width="10%">Accion</th>
							
							<th width="1%"> </th>
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
					<h4 class="modal-title">New product</h4>
				</div>
				<div class="modal-body">
					<label>Name Product</label>
					<input type="text" name="producto" id="producto" class="form-control" />
					<br />
					<label>price of sales</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="precio" id="precio" class="form-control" />
					<br />
					<label>Prand</label>
					<input type="text" onkeypress="return soloLetras(event);" name="marca" id="marca" class="form-control" />
					<br />
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_producto" id="id_producto" />
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
		$('.modal-title').text("Add Product");
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
		var producto = $('#producto').val();
		var precio = $('#precio').val();
		var marca = $('#marca').val();
		if( producto != '' && precio != ''  && marca != '')
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
		var id_producto = $(this).attr("id_producto");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_producto:id_producto},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#producto').val(data.producto);
				$('#precio').val(data.precio);
				$('#marca').val(data.marca);
				$('.modal-title').text("Edit Product");
				$('#id_producto').val(id_producto);
				$('#action').val("Edit");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_producto = $(this).attr("id_producto");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_producto:id_producto},
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
        var valor = document.getElementById("precio").value;
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
  var user = document.getElementById("producto").value;
  if(user == ""){
   alert("Porfavor escriba un producto.");
   window.location="#.php";
  }
}
</script>
<?php } else { ?>
<html>
	<head>
		<title>DPSTREET - Productos</title>
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
			<h1 align="center">Productos</h1>
			<br />
			<div class="table-responsive">
				<br />
				<div align="right">
					<button type="button" id="add_button" data-toggle="modal" data-target="#userModal" class="btn btn-success btn-lg">Nuevo Producto
					</button>
				</div>
				<br /><br />
				<table id="user_data" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th width="10%">ID</th>
							<th width="39%">Nombre del Producto</th>
							<th width="15%">Precio</th>
							<th width="25%">Marca</th>
							<th width="10%">Accion</th>
							
							<th width="1%"> </th>
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
					<h4 class="modal-title">Nuevo Producto</h4>
				</div>
				<div class="modal-body">
					<label>Nombre del Producto</label>
					<input type="text" name="producto" id="producto" class="form-control" />
					<br />
					<label>Precio de Venta</label>
					<input type="text" onkeypress="return soloNumeros(event);" name="precio" id="precio" class="form-control" />
					<br />
					<label>Marca</label>
					<input type="text" onkeypress="return soloLetras(event);" name="marca" id="marca" class="form-control" />
					<br />
					
				</div>
				<div class="modal-footer">
					<input type="hidden" name="id_producto" id="id_producto" />
					<input type="hidden" name="operation" id="operation" />
					<input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
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
		$('.modal-title').text("Agregar Producto");
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
		var producto = $('#producto').val();
		var precio = $('#precio').val();
		var marca = $('#marca').val();
		if( producto != '' && precio != ''  && marca != '')
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
		var id_producto = $(this).attr("id_producto");
		$.ajax({
			url:"fetch_single.php",
			method:"POST",
			data:{id_producto:id_producto},
			dataType:"json",
			success:function(data)
			{
				$('#userModal').modal('show');
				$('#producto').val(data.producto);
				$('#precio').val(data.precio);
				$('#marca').val(data.marca);
				$('.modal-title').text("Editar producto");
				$('#id_producto').val(id_producto);
				$('#action').val("Editar");
				$('#operation').val("Edit");
			}
		})
	});
	
	$(document).on('click', '.delete', function(){
		var id_producto = $(this).attr("id_producto");
		if(confirm("¿Estas seguro(a) que deseas eliminar este registro?"))
		{
			$.ajax({
				url:"delete.php",
				method:"POST",
				data:{id_producto:id_producto},
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
        var valor = document.getElementById("precio").value;
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
  var user = document.getElementById("producto").value;
  if(user == ""){
   alert("Porfavor escriba un producto.");
   window.location="#.php";
  }
}
</script>
<?php } ?>