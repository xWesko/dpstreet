<?php
session_start();
include_once 'ClsConexionBD.php';


?>
	<?php include "menu2.php"; 
	include "function.php";?>


   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<link rel=icon href='alien.ico' sizes="32x32" type="image/png">

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>DPSTREET</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="stylesheet" href="../libs/css/bootstrap.css">
  <link rel="stylesheet" href="../libs/css/bootstrap-theme.css">
  <link rel="stylesheet" href="../libs/css/style.css">
</head>
<body>
 

              
              
                 </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <div class="row" id="rows"> 

<br>

<ul class="nav nav-pills pull-left">
<li><h2><i class="glyphicon glyphicon-user"></i>&nbsp;Cuenta: <?php echo $_SESSION['cuenta'];?></h2></li>
</ul>   
<br><br><br>
<hr>

<h1>Cambio de contraseña</h1>

<?php
	function updateContrasena($usuario, $psw)
	{
		try {
            $sql = "UPDATE usuarios SET password=? WHERE cuenta=?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($psw, $usuario));
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    if(isset($_POST['enviar'])) 
    { 
        if($_POST['password'] != $_POST['Contrasena_conf']) 
        { 
            echo "Las contraseñas ingresadas no coinciden. <a href='javascript:history.back();'>Reintentar</a>"; 
        }
        else 
        { 
            $Cuenta = $_SESSION['cuenta']; 
            $psw = md5($_POST['password']); // encriptamos la nueva contraseña con md5 

            if($cambiarContrasena = updateContrasena($Cuenta, $psw)) 
            { 
                echo '
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong><a href="../../../../ag1/cart/productos.php"> Inicio</a>
                </div>'; 
            }
            else
            { 
                echo '
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Fail!</strong>
                </div>';
            }
        } 
    }

    if(isset($_SESSION['cuenta'])) 
    { // comprobamos que la sesión esté iniciada         
?> 
        <form method="post"> 
            <label class="">Nueva contraseña:</label><br /> 
            <input type="password" class="form-control" name="password" />
            <br/> 
            <label>Confirmar:</label>
            <br /> 
            <input type="password" class="form-control" name="Contrasena_conf" />
            <br/> 
            <input type="submit" class="btn btn-success" name="enviar" value="Enviar" /> 
        </form> 
<?php 
    }
    else 
    { 
        echo "Acceso denegado."; 
    } 
?>

 </div>
    <footer>
      <div class="row">
        <hr>
        <div class="col-lg-12" style="text-align: center;">
          <p>DPSTREET  &copy; 2018-2019</p>
          <p><?php echo $_SESSION['cuenta'];?></p>
        </div>
      </div>
    </footer>
  </div>

  <script src="jquery.js"></script>
  <script src="bootstrap.js"></script>
</body>
</html>			

