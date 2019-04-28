<?php include_once 'inc/header.php'?>
<?php
$login = Session::get("cuslogin");
if ($login==false) {
	header("location:login.php");
}
?>

<style type="text/css">
	.psuccess{width: 500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0 auto;}
  .psuccess h2{border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px}
  
  .psuccess p{line-height: 25px;font-size: 18px;text-align: left;}  
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        
        <div class="psuccess">
          <h2>Successful</h2>
          <p>Total Payble Amount(include vat):
          $<?php
        $cusorderid= Session::get("custId");
        $amount =$cr->paybleamount($cusorderid);
        if ($amount) {
          $sum = 0;
          while ($data = $amount -> fetch_assoc()) {
            $price = $data['price'];
            $sum = $sum + $price;
          }
        $vat = $sum * .1;
          $total = $sum + $vat;
          echo $total;
        }
        ?>
           </p>
          <p>Thanks for purchase.Receve your order successful.We will contract you ASAP with delivery details...<a href="orderdetails.php">Visit here</a> </p>     
        </div>
      
        
 		</div>
 	</div>
	</div>
  <?php include 'inc/footer.php'?>