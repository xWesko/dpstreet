<?php
include_once 'configuraciones/db/confighost.php';
$contador = (isset($_POST["contador"])) ? $_POST["contador"] +1:0;

session_start();
if(isset($_SESSION['cuenta'])){
 echo "<script>location.href='menu1.php'</script>";
} 

$config = new Config();
$db = $config->get_Connection();

if($_POST){
  
 include_once 'configuraciones/db/login.inc.php';
 $login = new Login($db);
 
 $login->userid = $_POST['cuenta']; 
 $login->passid = md5($_POST['password']);
  
 if($login->login()){
   
  echo "<script>location.href='menu1.php'</script>";
 }
  
 else{
  echo "<script>alert('Usuario y/o Contraseña no coinciden')</script>";
  if ($contador >= 3) {
    print'<script> window.location = "indexa2.php";</script>';

  }
  $contador = (isset($_POST["contador"])) ? $_POST["contador"] +1:0;
 }
}
?>