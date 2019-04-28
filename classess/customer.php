<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');
?>
<?php
class customer
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}

	public function customerregistration($value)
	{
		$name     =$this -> fm -> validation($value['name']);
		$city     =$this -> fm -> validation($value['city']);
		$zip      =$this -> fm -> validation($value['zip']);
		$email    =$this -> fm -> validation($value['email']);
		$adderss  =$this -> fm -> validation($value['address']);
		$country  =$this -> fm -> validation($value['country']);
		$phone    =$this -> fm -> validation($value['phone']);
		$password =$this -> fm -> validation($value['password']);

        $name     = mysqli_real_escape_string($this -> db -> link, $value['name']);
        $city     = mysqli_real_escape_string($this -> db -> link, $value['city']);
        $zip      = mysqli_real_escape_string($this -> db -> link, $value['zip']);
        $email    = mysqli_real_escape_string($this -> db -> link, $value['email']);
        $address  = mysqli_real_escape_string($this -> db -> link, $value['address']);
        $country  = mysqli_real_escape_string($this -> db -> link, $value['country']);
        $phone    = mysqli_real_escape_string($this -> db -> link, $value['phone']);
        $password = mysqli_real_escape_string($this -> db -> link, $value['password']);

        if ($name =="" || $city =="" || $zip =="" || $email =="" || $address =="" || $country =="" || $phone =="" || $password =="") {
         	echo "Field must not be empty";
         } 
        $mailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
        $mailcheck = $this -> db -> select($mailquery);
        if ($mailcheck != false) {
        	$msg = "Email address alredy exist";
        	return $msg;
        }else{

        $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,password) VALUES('$name','$address','$city','$country','$zip','$phone','$email','$password')";
        $res = $this -> db -> insert($query);
        if ($res) {
         	$msg = "registration Successful";
         	return $msg;
         }
        }

	}

        public function customerlogin($value)
        {
                $email =$this -> fm -> validation($value['email']);
                $pass  = $this -> fm -> validation($value['password']);

                $email = mysqli_real_escape_string($this -> db -> link, $value['email']);
                $pass  = mysqli_real_escape_string($this -> db -> link, $value['password']);

                if ($email == "" || $pass == "") {
                        $msg = "Field must not be empty";
                        return $msg;
                }

                $query = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$pass'";
                $res = $this -> db -> select($query);
                if ($res !=false) {
                        while ($data = $res -> fetch_assoc()) {
                                Session::set("cuslogin",true);
                                Session::set("custId",$data['customerId']);
                                Session::set("cusname",$data['name']);
                                header("location:order.php");
                        }
                }else{
                        $msg = "Email and password not match";
                        return $msg;
                        }
        } 

        public function getcusalldata1($getcussid)
        {
                $query = "SELECT * FROM tbl_customer WHERE customerId='$getcussid'";
                $res = $this -> db -> select($query);
                return $res;
        }
}	
?>	
