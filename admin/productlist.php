<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classess/product.php'; ?>
<?php include_once '../helpers/formate.php';?>
<?php
$pd = new product();
$fm = new Formate();
?>
<?php
if (isset($_GET['delId'])) {
	$delId=$_GET['delId'];
	$delrow=$pd->delpro($delId);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
        	<?php
            if (isset($delrow)) {
            	echo $delrow;
              }
            ?>

            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Producr Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$data =$pd -> getproduct();
				$i=0;
				if ($data) {
					while ($res = $data -> fetch_assoc()) {
						$i++;

				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $res['productName'];?></td>
					<td><?php echo $res['categoryName'];?></td>
					<td><?php echo $res['brandName'];?></td>
					<td><?php echo $fm ->textShorten($res['body'], 30) ;?></td>
					<td>$<?php echo $res['price'];?></td>
					<td><img src="<?php echo $res['image'];?>" width="50px" height="60"> </td>
					<td><?php
					     if ($res['type']=='0') {
					       	echo "Featured";
					       }  else{
					       	echo "General";
					       }
					     ?>     	
					 </td>
					<td><a href="proedit.php?proid=<?php echo $res['productId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delId=<?php echo $res['productId'];?>">Delete</a></td>
				</tr>
				<?php }}?>
			
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
