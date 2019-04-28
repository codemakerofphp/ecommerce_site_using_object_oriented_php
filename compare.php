<?php include 'inc/header.php'?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    
						<table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php
							$getcart = $cr -> getcart();
							if ($getcart) {
								$i =0;
								while ($data = $getcart -> fetch_assoc()) {
								$i++

							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $data['productName']?></td>
								<td><img src="admin/<?php echo $data['image']?>" alt=""/></td>
								<td>Tk.<?php echo $data['price']?></td>
								<td><a href="details.php?proid=<?php echo $data['productId']?>">View</a></td>
							</tr>
							<?php
							 $qut = $qut + $data['quantity'];
							 $sum = $sum + $total;
							 Session::set("sum",$sum); 
							 Session::set("qut",$qut);
							 ?>
							<?php }}?>

							
						</table>
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
