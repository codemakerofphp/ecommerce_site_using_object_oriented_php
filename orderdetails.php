<?php
include_once'inc/header.php';
?>
<?php
$login = Session::get("cuslogin");
if ($login==false) {
	header("location:login.php");
}
?>
<?php
if (isset($_GET['custid'])) {
	$id = $_GET['custid'];
	$price = $_GET['price'];
	$time = $_GET['time'];
    $getconshift = $cr -> getconshifted($id,$price,$time);
    if ($getconshift) {
       echo $getconshift;
   }
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<div class="order">
				<h2>Your Oreder product</h2>
				<table class="tblone">
							<tr>
								<th >SL</th>
								<th >Product Name</th>
								<th >Image</th>
								<th >Quantity</th>
								<th > Price</th>
								<th > Date</th>
								<th > Status</th>
								<th>Action</th>
							</tr>
							<?php
							$cusorderid= Session::get("custId");
							$getorder = $cr -> getorderproduct($cusorderid);
							if ($getorder) {
								$i =0;
								while ($data = $getorder -> fetch_assoc()) {
								$i++

							?>
							<tr>
								<td><?php echo $i?></td>
								<td><?php echo $data['productname']?></td>
								<td><img src="admin/<?php echo $data['image']?>" alt=""/></td>
								<td><?php echo $data['quantity']?></td>
								
								<td>Tk. <?php echo $data['price'];?></td>
								 <td><?php echo $fm -> formatDate($data['date'])?></td>
								 <td>
								 	<?php
								 if ($data['status']=='0') {
								 	echo "Pending";
								 }elseif ($data['status']=='1') {
								 	echo "Shifted";
								  }else{
								 	echo "OK";
								 }
								 ?>
								 </td>
								 <?php
                                 if ($data['status']=='1') { ?>
                                <td><a href="?custid=<?php echo $cusorderid?> & price=<?php echo $data['price']?> & time=<?php echo $data['date']?>">Comfirm</a></td>
                                <?php  
                                 }elseif ($data['status']=='2') { ?>
                                 	<td>OK</td>
                                 <?php 
                                } elseif($data['status']=='0'){ ?>

                                 <td>N/A</td>
                                 <?php }
								 ?>
								
							</tr>
							
							<?php }}?>

							
						</table>
			</div>
			
		</div>
		<div class="clear"></div>
		
	</div>
</div>
<?php 
include 'inc/footer.php';
?>