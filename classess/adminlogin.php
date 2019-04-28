<?php 
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/session.php');
Session::checkLogin();
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');

?>

<?php

class Adminlogin 
{
	private $db;
	private $fm; 
	
	public function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}
    public function adminlogin($adminuser,$adminpass )
	{

		$adminuser = $this -> fm -> validation($adminuser);
		$adminpass = $this -> fm -> validation($adminpass);

		$adminuser = mysqli_real_escape_string($this -> db -> link,$adminuser);
		$adminpass = mysqli_real_escape_string($this -> db -> link,$adminpass);

		if (empty($adminuser) || empty($adminpass)) {
			$lonmsg = "Username and password must not be empty";
			return $lonmsg;
		}else{
			$query = "SELECT * FROM tbl_admin Where adminUser='$adminuser' AND adminPass='$adminpass'";
		    $result = $this -> db -> select($query);
		    if ($result != false) {
	            $value = $result -> fetch_assoc();

	            Session::set("adminlogin",true);
	            Session::set("adminid",$value['adminId']);
	            Session::set("adminname",$value['adminName']);
	            Session::set("admimuser",$value['adminUser']);
	            header('location:dashbord.php');

		    }else{
		    	$longmsg = "User name and Password not match";
		    	return $longmsg; 
		    }

		}
		
	}
}
?>