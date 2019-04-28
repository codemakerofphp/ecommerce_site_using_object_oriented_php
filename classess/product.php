<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/database.php');
include_once ($filepath.'/../helpers/formate.php');

?>
<?php

class product
{
	private $db;
	private $fm;
	
	function __construct()
	{
		$this -> db = new Database();
		$this -> fm = new Formate();
	}
	public function productinsert($value,$file)

	{
		$productName = $this -> fm ->validation($value['productName']);
		$id          = $this -> fm -> validation($value['id']);
		$brandId     = $this -> fm -> validation($value['brandId']);
		$body        = $this -> fm -> validation($value['body']);
		$price       = $this -> fm -> validation($value['price']);
		$type        = $this -> fm -> validation($value['type']);

		$productName = mysqli_real_escape_string($this -> db -> link,$value['productName']);
		$id          = mysqli_real_escape_string($this -> db -> link,$value['id']);
		$brandId     = mysqli_real_escape_string($this -> db -> link,$value['brandId']);
		$body        = mysqli_real_escape_string($this -> db -> link,$value['body']);
		$price       = mysqli_real_escape_string($this -> db -> link,$value['price']);
		$type        = mysqli_real_escape_string($this -> db -> link,$value['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName=="" || $id=="" || $brandId=="" || $body=="" || $price=="" || $type=="" || $file_name=="") {
	    	$msg = "Field must not be empty";
	    	return $msg;
	    } elseif ($file_size >1048567) {
		    echo "<span class='error'>Image Size should be less then 1MB! </span>";
	    } elseif (in_array($file_ext, $permited) === false) {
            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
        } else{
	    	move_uploaded_file($file_temp, $uploaded_image);

	    	$query = "INSERT INTO tbl_product(productName,id,brandId,body,price,image,type) VALUES('$productName','$id','$brandId','$body','$price','$uploaded_image','$type')";
	    	$insertpro = $this -> db -> insert($query);
	    	if ($insertpro) {
	    		$msg = "product Insert Successful";
	    		return $msg;
	    	}else{
	    		$msg = "Product not Inserted";
	    		return $msg;
	    	}
	    }
	}

	public function getproduct()
	{
		$query = "SELECT p.*,c.categoryName,b.brandName
		         FROM tbl_product as p, tbl_category as c, tbl_brand as b
		         WHERE p.Id = c.Id AND p.brandId = b.brandId
		         ORDER BY p.productId DESC";
		/*$query = "SELECT tbl_product.*, tbl_category.categoryName, tbl_brand.brandName  
                  FROM tbl_product
                  INNER JOIN tbl_category
                  ON tbl_product.Id = tbl_category.Id
                  INNER JOIN tbl_brand
                  ON tbl_product.brandId = tbl_brand.brandId

		          ORDER BY tbl_product.productId DESC";*/
		$datarow = $this -> db -> select($query);
		if ($datarow) {
			return $datarow;
		}
	}

	public function getprodbyid($id)
	{
		$query = "SELECT * FROM tbl_product WHERE productId ='$id'";
		$result = $this -> db -> select($query);
		return $result;
	}

	public function  updatepro($value, $file, $id1)
	{
		$productName = $this -> fm ->validation($value['productName']);
		$id          = $this -> fm -> validation($value['id']);
		$brandId     = $this -> fm -> validation($value['brandId']);
		$body        = $this -> fm -> validation($value['body']);
		$price       = $this -> fm -> validation($value['price']);
		$type        = $this -> fm -> validation($value['type']);

		$productName = mysqli_real_escape_string($this -> db -> link,$value['productName']);
		$id          = mysqli_real_escape_string($this -> db -> link,$value['id']);
		$brandId     = mysqli_real_escape_string($this -> db -> link,$value['brandId']);
		$body        = mysqli_real_escape_string($this -> db -> link,$value['body']);
		$price       = mysqli_real_escape_string($this -> db -> link,$value['price']);
		$type        = mysqli_real_escape_string($this -> db -> link,$value['type']);

		$permited  = array('jpg', 'jpeg', 'png', 'gif');
	    $file_name = $file['image']['name'];
	    $file_size = $file['image']['size'];
	    $file_temp = $file['image']['tmp_name'];

	    $div = explode('.', $file_name);
	    $file_ext = strtolower(end($div));
	    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
	    $uploaded_image = "upload/".$unique_image;

	    if ($productName=="" || $id=="" || $brandId=="" || $body=="" || $price=="" || $type=="") {
	    	$msg = "Field must not be empty";
	    	return $msg;
	    }else{
	    	if (!empty($file_name)) {

			     if ($file_size >1048567) {
				    echo "<span class='error'>Image Size should be less then 1MB! </span>";
			     } elseif (in_array($file_ext, $permited) === false) {
		            echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
		         } else{
			    	move_uploaded_file($file_temp, $uploaded_image);
			    	$query = "UPDATE tbl_product
			    	          SET
			    	          productName = '$productName',
			    	          Id          = '$id',
			    	          brandId     = '$brandId',
			    	          body        = '$body',
			    	          price       = '$price',
			    	          image       = '$uploaded_image',
			    	          type        = '$type'
			    	          WHERE productId = '$id1'";
			    	$updaterow = $this -> db -> update($query);
			    	if ($updaterow) {
			    		$msg = "product Update Successful";
			    		return $msg;
			    	}else{
			    		$msg = "Product not updated";
			    		return $msg;
			    	}
			     }
			   }else{
			    	$query = "UPDATE tbl_product
			    	          SET
			    	          productName = '$productName',
			    	          Id          = '$id',
			    	          brandId     = '$brandId',
			    	          body        = '$body',
			    	          price       = '$price',
			    	          type        = '$type'
			    	          WHERE productId = '$id1'";
			    	$updaterow = $this -> db -> update($query);
			    	if ($updaterow) {
			    		$msg = "product Update Successful";
			    		return $msg;
			    	}else{
			    		$msg = "Product not updated";
			    		return $msg;
			    	}

			    }
	  }	
	}

	public function delpro($delId)
	{
		$query = "SELECT * FROM tbl_product WHERE productId = '$delId'";
		$getrow = $this -> db -> select($query);
		if ($getrow) {
			while ($data = $getrow -> fetch_assoc()) {
				$imagelink = $data['image'];
				unlink($imagelink);
			}
		}
		$query = "DELETE FROM tbl_product WHERE productId = '$delId'";
		$delrow = $this -> db -> delete($query);
		if ($delrow) {
			$msg = "delete successful";
			return $msg;
		}else{
			$msg = "Delete unsuccessful";
			return msg;
		}
	}

	public function getfetpro()
	{
		$query = "SELECT * FROM tbl_product WHERE type ='0' ORDER BY productId DESC LIMIT 4";
		$result = $this -> db -> select($query);
		return $result;
	}

	public function getnewpro()
	{
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$result = $this -> db -> select($query);
		return $result;
	}

	public function getsinglepro($id)
	{
		$query = "SELECT p.*,c.categoryName,b.brandName
		         FROM tbl_product as p, tbl_category as c, tbl_brand as b
		         WHERE p.Id = c.Id AND p.brandId = b.brandId AND p.productId='$id'";
		
		$datarow = $this -> db -> select($query);
		if ($datarow) {
			return $datarow;
		}
	}

	public function Iphonetbrand()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productID DESC LIMIT 1";
		$res = $this -> db -> select($query);
		if ($res) {
			return $res;
		}
		
	}

	public function Samsungbrand()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productID DESC LIMIT 1";
		$res = $this -> db -> select($query);
		if ($res) {
			return $res;
		}
		
	}

	public function Acerbrand()
	{
		$query = "SELECT * FROM tbl_product WHERE brandId='5' ORDER BY productID DESC LIMIT 1";
		$res = $this -> db -> select($query);
		if ($res) {
			return $res;
		}
		
	}

	public function Canonbrand() 
	{
		$query = "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productID DESC LIMIT 1";
		$res = $this -> db -> select($query);
		if ($res) {
			return $res;
		}
		
	}

	public function getcatbyid($id)
	{
		$query = "SELECT * FROM tbl_product WHERE Id ='$id'";
		$res = $this -> db -> select($query);
		return $res;
	}
	public function insertcompare($comId,$comrid)
	{
		$query = "SELECT * FROM tbl_product WHERE productId = '$comrid'";
		$data = $this -> db -> select($query) ->fetch_assoc();
		if ($data) {
			
				$productId = $data['productId'];
				$productName = $data['productName'];
				$price = $data['price'];
				$image = $data['image'];

				$query1 = "INSERT INTO tbl_compare(cusId,productId,productName,price,image) VALUES('$comId','$productId','$productName','$price','$image')";
				$insertrow = $this -> db -> insert($query1);

				if ($insertrow) {
					$msg = "Add to compare";
					return $msg;
				}else{
					$msg = "Not Added"
					return $msg;
				}
		}
	}
}
?>