<?php
require_once ("ClsConexionBD.php");
class updateContrasena {

function updateContrasena($Usuario, $psw)
	{
		try {
            $sql = "UPDATE usuarios SET password=? WHERE id_cliente=?";
            
            $objBD = ConexionBD::getInstance()->getDb()->prepare($sql);
            
            $objBD->execute(array($psw, $Usuario));
            return true;
        } catch (PDOException $e) {
            return false;
        }
		// try
		// {
		// 	//SELECT CONCAT(CURRENT_DATE(),' ',CURRENT_TIME()))
		// 	$sql="UPDATE clientes SET psw=:psw WHERE usuario=:usuario";
		// 	$stmt=$this->db->prepare($sql);
		// 	$stmt->bindparam(":usuario",$usuario);
		// 	$stmt->bindparam(":psw",$contrasena);
			
		// 	$stmt->execute();

		// 	return true;	
		// }
		// catch(PDOException $e)
		// {
		// 	echo $e->getMessage();	
		// 	return false;
		// }
	}


}

?>