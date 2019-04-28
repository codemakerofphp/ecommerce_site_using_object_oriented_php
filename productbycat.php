<?php include 'inc/header.php'?>

<?php
if (isset($_GET['procatid'])) {
	$procatid = $_GET['procatid'];
}
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Latest from Category</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
            $getcatpro = $pd -> getcatbyid($procatid);
            if ($getcatpro) {
            	while ($data = $getcatpro -> fetch_assoc()) {
            		
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $data['productId']?>"><img src="admin/<?php echo $data['image']?>" alt="" /></a>
					<h2><?php echo $data['productName']?> </h2>
					  <p><?php echo $fm -> textShorten($data['body'],60)?></p>
					 <p><span class="price">$<?php echo $data['price']?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $data['productId']?>" class="details">Details</a></span></div>
				</div>
		     <?php 
		     }} else{
		     	echo "This category product are not avalable";
		     }
		     ?> 
			</div>

	
	
    </div>
 </div>
<?php include 'inc/footer.php'?>

