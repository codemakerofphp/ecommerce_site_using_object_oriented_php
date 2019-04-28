<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');
?>

<?php

class addcategory
{
	private $db;
	private $fm;
	
	public function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}
	public function catadd($catname)
	{
		$catname = $this -> fm -> validation($catname);
		$catname = mysqli_real_escape_string($this -> db -> link,$catname);

		if (empty($catname)) {
			$catmsg = "field must not be empty";
			return $catmsg;
		}else{
			$query = "INSERT INTO tbl_category(categoryName) VALUES('$catname')";
			$result = $this -> db ->insert($query);
			if ($result) {
				$catmsg ="Insert Successful";
				return $catmsg; 
			}else{
				$catmsg = "Data not Inserted";
				return $catmsg;
			}
		}
	}
	public function catlist()
	{
		$query = "SELECT * FROM tbl_category ORDER BY id DESC";
		$result = $this -> db -> select($query);
		return $result;
	}
	public function getcat($id)
	{
		$query = "SELECT * FROM tbl_category WHERE id ='$id'";
		$result = $this -> db -> select($query);
		return $result;
	}
	public function catupdate($catname,$id)
	{
		$catname = $this -> fm -> validation($catname);
		$catname = mysqli_real_escape_string($this -> db -> link,$catname);
		$id      = mysqli_real_escape_string($this -> db -> link,$id);
		if (empty($catname)) {
			$msg = "field must not be empty";
			return $msg;
		}else{
			$query="UPDATE tbl_category
		        SET 
		        categoryName='$catname'
		        WHERE id='$id'";
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
	public function delcat($delid)
	{
		$query = "DELETE FROM tbl_category WHERE id='$delid'";
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
?>