<?php include 'inc/header.php'?>
<?php include 'inc/slider.php'?>
	

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      	$getfetpro = $pd -> getfetpro();
	      	if ($getfetpro) {
	      		while ($data = $getfetpro -> fetch_assoc()) {

	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $data['productId']?>"><img src="admin/<?php echo $data['image']?>" alt="" /></a>
					 <h2><?php echo $data['productName']?> </h2>
					 <p><?php echo $fm -> textShorten($data['body'],60)?></p>
					 <p><span class="price">$<?php echo $data['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $data['productId']?>" class="details">Details</a></span></div>
				</div>
			<?php }}?>
			
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">

				<?php
	         	$getnewpro = $pd -> getnewpro();
	      	    if ($getnewpro) {
	      		while ($data = $getnewpro -> fetch_assoc()) {

	         	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $data['productId']?>"><img src="admin/<?php echo $data['image']?>" alt="" /></a>
					 <h2><?php echo $data['productName']?> </h2>
					 <p><span class="price">$<?php echo $data['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $data['productId']?>" class="details">Details</a></span></div>
				</div>
			<?php }}?>
			</div>
    </div>
 </div>

<?php include 'inc/footer.php'?>