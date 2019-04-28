<?php include 'inc/header.php'?>
<?php
if (isset($_GET['delpro'])) {
	$cartdelid = $_GET['delpro'];
	$delfromcart = $cr -> deletefromcart($cartdelid);
}
?>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
	$cartId   = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	$updatequentity = $cr -> updatequentity($cartId,$quantity);

	if ($quantity <= 0) {
		$delfromcart = $cr -> deletefromcart($cartId);
	}
	}
?>
<?php
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=sh'/>";
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>

			    		<?php
			    	if (isset($delfromcart)) {
			    		echo $delfromcart;
			    	}
			    	?>

			    	<?php
			    	if (isset($updatequentity)) {
			    		echo $updatequentity;
			    	}
			    	?>
			    
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="10%">Price</th>
								<th width="20%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$getcart = $cr -> getcart();
							if ($getcart) {
								$i =0;
								$sum = 0;
								$qut = 0;
								while ($data = $getcart -> fetch_assoc()) {
								$i++

							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $data['productName']?></td>
								<td><img src="admin/<?php echo $data['image']?>" alt=""/></td>
								<td>Tk.<?php echo $data['price']?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $data['cartId']?>"/>
										<input type="number" name="quantity" value="<?php echo $data['quantity']?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>Tk. <?php 
                                        $total = $data['price'] * $data['quantity'];
								        echo $total;
								       ?></td>
								<td><a onclick = "return confirm('Are you sure to delete')" href="?delpro=<?php echo $data['cartId'];?>">X</a></td>
							</tr>
							<?php
							 $qut = $qut + $data['quantity'];
							 $sum = $sum + $total;
							 Session::set("sum",$sum); 
							 Session::set("qut",$qut);
							 ?>
							<?php }}?>

							
						</table>
						<?php
						$getdata = $cr -> checkcartdata();
						if ($getdata) {
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>TK.<?php echo $sum;?> </td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>TK. 10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>TK.<?php
								   $vat = $sum * .10;
								   $gtotal = $vat + $sum;
								   echo $gtotal;
								   ?> </td>
							</tr>
					   </table>
					<?php }else{
						echo "Cart Empty";
					} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'?>
