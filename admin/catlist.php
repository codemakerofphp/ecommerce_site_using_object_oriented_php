 <?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/addcategory.php'; ?>
<?php
$cl = new addcategory();
if (isset($_GET['delid'])) {
	$delid=$_GET['delid'];
	$delrow=$cl->delcat($delid);
}
?>     

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">    
                 
                    <table class="data display datatable" id="example">
                    	 <?php
			                if (isset($delrow)) {
			                	echo $delrow;
			                }
			             ?>  
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
						$data = $cl -> catlist();
						if ($data) {
							$i=0;
							while ($result = $data -> fetch_assoc()) {
								$i++;
						?>

						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['categoryName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure to delete!')" href="?delid=<?php echo $result['id'];?>">Delete</a></td>
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

