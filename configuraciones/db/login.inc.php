<?php 
class Login
{
 private $conn;
 private $table_name = "usuarios";
  
    public $user;
    public $userid;
    public $passid;
 
    public function __construct($db){
  $this->conn = $db;
 }
 
    public function login()
    {
        $user = $this->checkCredentials();
        if ($user) {
            $this->user = $user;
 
			$_SESSION['cuenta'] = $user['cuenta'];
			$_SESSION['idioma'] = $user['idioma'];
			
			
            return $user['cuenta'];
			return $userid['cuenta'];
		    return $passid['password'];

			
        }
        return false;
    }
 
    protected function checkCredentials()
    {
        $stmt = $this->conn->prepare('select * from '.$this->table_name.' where cuenta=? and password=? ');
  $stmt->bindParam(1, $this->userid);
  $stmt->bindParam(2, $this->passid);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
	
$data = $stmt->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = $this->passid;
            if ($submitted_pass == $data['password']) {
                return $data;
            }
        }
        return false;
    }
 
    public function getUser()
    {
        return $this->user;
    }
}
?>