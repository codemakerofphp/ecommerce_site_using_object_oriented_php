<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');
?>

<?php

class brand
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}
	public function setbrand($brandname)
	{
		$brandname = $this -> fm -> validation($brandname);
		$brandname = mysqli_real_escape_string($this -> db -> link,$brandname);

		if (empty($brandname)) {
			$banmsg = "field must not be empty";
			return $banmsg;
		}else{
			$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandname')";
			$result = $this -> db ->insert($query);
			if ($result) {
				$banmsg ="Insert Successful";
				return $banmsg; 
			}else{
				$banmsg = "Data not Inserted";
				return $banmsg;
			}
		}
	}

	public function getbrand()
	{
		$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result = $this -> db -> select($query);
		return $result;
	}
	public function brandlist($id)
	{
		$query = "SELECT * FROM tbl_brand WHERE brandId ='$id'";
		$result = $this -> db -> select($query);
		return $result;
	}

	public function brandupdate($brandname,$id)
	{
		$brandname = $this -> fm -> validation($brandname);
		$brandname = mysqli_real_escape_string($this -> db -> link,$brandname);
		$id      = mysqli_real_escape_string($this -> db -> link,$id);
		if (empty($brandname)) {
			$msg = "field must not be empty";
			return $msg;
		}else{
			$query="UPDATE tbl_brand
		        SET 
		        brandName='$brandname'
		        WHERE brandId='$id'";
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

	public function delbrand($delid)
	{
		$query = "DELETE FROM tbl_brand WHERE brandId='$delid'";
		$res=$this -> db -> delete($query);
		if ($res) {
			$msg="Delete successful";
			return $msg;
		}else{
			$msg="Delete not successful";
			return $msg;
		}
	}

}	