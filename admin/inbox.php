<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classess/cart.php');
include_once ($filepath.'/../helpers/formate.php');
$cr = new cart();
$fm = new Formate();
?>
<?php
if (isset($_GET['custid'])) {
	$id = $_GET['custid'];
	$price = $_GET['price'];
	$time = $_GET['time'];
    $getshift = $cr -> getshifted($id,$price,$time);
    if ($getshift) {
       echo $getshift;
   }
}
   if (isset($_GET['delcustid'])) {
	$id = $_GET['delcustid'];
	$price = $_GET['price'];
	$time = $_GET['time'];
    $delgetshift = $cr -> delgetshifted($id,$price,$time);
    if ($delgetshift) {
       echo $delgetshift;
   }
    
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer Id</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$getorpro = $cr -> getallorpro();
						if ($getorpro) {
							while ($data = $getorpro -> fetch_assoc()) {

						?>
						<tr class="odd gradeX">
							<td><?php echo $data['productId']?></td>
							<td><?php echo $fm ->formatDate($data['date'])?></td>
							<td><?php echo $data['productname']?></td>
							<td><?php echo $data['quantity']?></td>
							<td><?php echo $data['price']?></td>
							<td><?php echo $data['cusId']?></td>
							<td>
								<a href="customer.php?cusid=<?php echo $data['cusId']?> ">View Details </a>
							</td>
							<?php
							if ($data['status']=='0') { ?>
							<td><a href="?custid=<?php echo $data['cusId']?> & price=<?php echo $data['price']?> & time=<?php echo $data['date']?>">Shifted</a></td>	
							<?php
							}elseif ($data['status']=='1') {
							?>
							<td>Pending</td>
						<?php		
							}else{ ?>
                            <td><a href="?delcustid=<?php echo $data['cusId']?> & price=<?php echo $data['price']?> & time=<?php echo $data['date']?>">Remove</a></td>
                            <?php
							}
							?>
							
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
