<?php include 'inc/header.php'?>
<?php
$login = Session::get("cuslogin");
if ($login==false) {
	header("location:login.php");
}
?>

<style type="text/css">
	.tblone{width: 550px;margin: 0 auto;border: 2px solid #ddd;}
	.tblone tr td{text-align: justify;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    <?php
    $getcussid = Session::get("custId");
    $getcuspro = $cum -> getcusalldata1($getcussid);
    if ($getcuspro) {
    	while ($data = $getcuspro -> fetch_assoc()) {
    ?>		
          <table class="tblone">
          	<tr>
          		<td width="20%">Name</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['name']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">Phone</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['phone']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">Email</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['email']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">Adderss</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['address']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">Zipcode</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['zip']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">Cityame</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['city']?>
          		</td>
          	</tr>
          	<tr>
          		<td width="20%">country</td>
          		<td width="5%">:</td>
          		<td>
          			<?php echo $data['country']?>
          		</td>
          	</tr>
          	
          </table>
      <?php }}?>
 		</div>
 	</div>
	</div>
  <?php include 'inc/footer.php'?>