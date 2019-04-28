<?php include 'inc/header.php'?>
 <div class="main">
	<?php
	if (isset($_GET['proid']) ) {
	    $id = $_GET['proid'];
	}

	if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
	    $cartpro = $cr -> addtocart($_POST,$id);
	}

	?>
	
    <div class="content">
    	<div class="section group">
    		<?php
    		$getsinglepro= $pd -> getsinglepro($id);  
    		if ($getsinglepro) {
    			while ($data = $getsinglepro -> fetch_assoc()) {

    		?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $data['image']?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $data['productName']?> </h2>
						
					<div class="price">
						<p>Price: <span>$<?php echo $data['price']?></span></p>
						<p>Category: <span><?php echo $data['categoryName']?></span></p>
						<p>Brand:<span><?php echo $data['brandName']?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
					</div>
					<?php
                    if (isset($cartpro)) {
                     	echo $cartpro;
                     } 
					?>
					<?php
					if (isset($_GET['compareid'])) {
						$cmpId = Session::set('compareid');
						$comrid = $_GET['compareid'];
						$insertcom = $pd -> insertcompare($comId,$comrid);
					}
					?>
					<div class="add-cart">
					<form action="" method="post">
						<a class="buysubmit" href="?wlistid=<?php echo $data['productId']?>">Save To List</a>
						<a class="buysubmit" href="?compareid=<?php echo $data['productId']?>"">Add To Compare</a>
					</form>				
					</div>

				</div>
				<div class="product-desc">
				<h2>Product Details</h2>
				<p><?php echo $data['body']?></p>
	         </div>
				
	      </div>
         <?php }}?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						$getcategorylist= $ct -> catlist();
						if ($getcategorylist) {
							while ($data = $getcategorylist -> fetch_assoc()) {
						?>

				      <li><a href="productbycat.php?procatid=<?php echo $data['id']?>"><?php echo $data['categoryName']?></a></li>
				      <?php }}?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
  <?php include 'inc/footer.php'?>