
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');
?>

<?php
class cart
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}

	public function addtocart($value,$id)
	{
		$quantity = $this -> fm ->validation($value['quantity']);
		$quantity = mysqli_real_escape_string($this -> db -> link,$value['quantity']);
		$productId = mysqli_real_escape_string($this -> db -> link,$id);
		$sessionId = session_id();

		$query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$getpro = $this -> db -> select($query);
		$data = $getpro -> fetch_assoc();

		$productName = $data['productName'];
		$price = $data['price'];
		$image = $data['image'];

		$cquery = "SELECT * FROM tbl_cart WHERE productId ='$productId' AND sId = '$sessionId'";
		$getr = $this -> db -> select($cquery);
		if ($getr) {
			$msg= "Product Alredy Added";
			return $msg;
		}else{

		$query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) VALUES('$sessionId','$productId','$productName','$price','$quantity','$image')";
	    	$cartpro = $this -> db -> insert($query);
	    	if ($cartpro) {
	    		header('location:cart.php');
	    	}else{
	    		header('location:404.php');
	    	}
	    }	
	}

	public function getcart()
	{
		$sessionId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sessionId'";
		$res = $this -> db -> select($query);
		if ($res) {
			return $res;
		}
	}

	public function updatequentity($cartId,$quantity)
	{
		$cartId = mysqli_real_escape_string($this -> db -> link, $cartId);
		$quantity = mysqli_real_escape_string($this -> db -> link, $quantity);

		$query="UPDATE tbl_cart
		        SET 
		        quantity='$quantity'
		        WHERE cartId='$cartId'";
		    $update_row=$this -> db -> update($query);
		    if ($update_row) {
		        	header("location:cart.php");
		        } else{
		        	$msg="quantity Update not successful";
		        	return $msg; 
		        } 

	}

	public function  deletefromcart($cartdelid)
	{
		$query = "DELETE FROM tbl_cart WHERE cartId='$cartdelid'";
		$res=$this -> db -> delete($query);
		
		if ($res) {
			header("location:cart.php");

		}else{
			$msg="Delete not successful";
			return $msg;
		}
	}
	public function checkcartdata()
	{
		$sessionId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sessionId'";
		$res = $this -> db -> select($query);
		return $res;
	}

	public function delcustomercart()
	{
		$sid = session_id();
		$query="DELETE FROM tbl_cart WHERE sId='$sid'";
		$res = $this -> db -> delete($query);
	}

	public function insertcusorder($insertorder)
	{
		$sessionId = session_id();
		$query = "SELECT * FROM tbl_cart WHERE sId = '$sessionId'";
		$res = $this -> db -> select($query);
		if ($res) {
			while ($data = $res -> fetch_assoc()) {
				$productId = $data['productId'];
				$productName = $data['productName'];
				$quantity = $data['quantity'];
				$price = $data['price'] * $quantity;
				$image = $data['image'];

				$query1 = "INSERT INTO tbl_order(cusId,productId,productName,quantity,price,image) VALUES('$insertorder','$productId','$productName','$quantity','$price','$image')";
				$insertrow = $this -> db -> insert($query1);

			}
		}
	}

	public function paybleamount($cusorderid)
	{
		$query = "SELECT price FROM tbl_order WHERE cusId = '$cusorderid' AND date=now()";
		$res = $this -> db -> select($query);
		return $res;
	}

	public function getorderproduct($cusorderid)
	{
		$query = "SELECT * FROM tbl_order WHERE cusId = '$cusorderid' ORDER BY productId DESC";
		$res = $this -> db -> select($query);
		return $res;
	}
	public function checkorderpro($cusid)
	{
		$query = "SELECT * FROM tbl_order WHERE cusId = '$cusid'";
		$res = $this -> db -> select($query);
		return $res;
	}

	public function getallorpro()
	{
		$query = "SELECT * FROM tbl_order ORDER BY date DESC";
		$res = $this -> db -> select($query);
		return $res;
		
	}

	public function getshifted($id,$price,$time)
	{
		$query="UPDATE tbl_order
		        SET 
		        status='1'
		        WHERE cusId='$id' AND price='$price' AND date='$time'";
		    $update_row=$this -> db -> update($query);
		    if ($update_row) {
		        	$msg ="Update Successful";
		        	return $msg;
		        } else{
		        	$msg="Update not successful";
		        	return $msg; 
		        } 
	}

	public function delgetshifted($id,$price,$time)
	{
		$query = "DELETE FROM tbl_order WHERE cusId='$id' AND price='$price' AND date='$time'";
		$res=$this -> db -> delete($query);
		if ($res) {
			$msg="Delete successful";
			return $msg;
		}else{
			$msg="Delete not successful";
			return $msg;
		}
	}

	public function getconshifted($id,$price,$time)
	{
		$query="UPDATE tbl_order
		        SET 
		        status='2'
		        WHERE cusId='$id' AND price='$price' AND date='$time'";
		    $update_row=$this -> db -> update($query);
		    if ($update_row) {
		        	$msg ="Update Successful";
		        	return $msg;
		        } else{
		        	$msg="Update not successful";
		        	return $msg; 
		        } 
	}
}	
?>	
