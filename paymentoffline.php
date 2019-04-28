<?php include_once 'inc/header.php'?>
<?php
$login = Session::get("cuslogin");
if ($login==false) {
	header("location:login.php");
}
?>
<?php
if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
  $cusorderid= Session::get("custId");
  $insertorder = $cr -> insertcusorder($cusorderid);
  $deldata = $cr -> delcustomercart();
  header("location:success.php");
}
?>

<style type="text/css">
  .division{width: 50%;float: left;}
	.tblone{width: 400px;margin: 0 auto;border: 2px solid #ddd;}
  .tblone tr td{text-align: justify;}
  .tbltwo{float:right;text-align:left;width: 60%;border:2px solid #ddd; margin-right: 14px;margin-top: 12px}
  .tbltwo{text-align: justify;padding: 5px 10px}
  .order{padding-bottom: 30px}
  .order a{width: 200px;margin: 20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: #ff0000;color: #fff;border-radius: 3px}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="division">
          <table class="tblone">
              <tr>
                <th >No</th>
                <th > Name</th>
                <th >Price</th>
                <th >Quantity</th>
                <th >Total Price</th>
              </tr>
              <?php
              $getcart = $cr -> getcart();
              if ($getcart) {
                $i =0;
                $sum = 0;
                $qut = 0;
                while ($data = $getcart -> fetch_assoc()) {
                $i++

              ?>
              <tr>
                <td><?php echo $i?></td>
                <td><?php echo $data['productName']?></td>
                <td>Tk.<?php echo $data['price']?></td>
                <td><?php echo $data['quantity']?></td>
               
                <td>Tk. <?php 
                       $total = $data['price'] * $data['quantity'];
                        echo $total;
                       ?></td>
               
              </tr>
              <?php
               $qut = $qut + $data['quantity'];
               $sum = $sum + $total;
              
               ?>
              <?php }}?>

              
            </table>
           <?php
            $getdata = $cr -> checkcartdata();
            if ($getdata) {
            ?>
            <table class="tbltwo" >
              <tr>
                <td>Sub Total  </td>
                <td>: </td>
                <td>TK.<?php echo $sum;?> </td>
              </tr>
              <tr>
                <td>VAT </td>
                 <td>: </td>
                <td>TK. 10% ($<?php echo $vat =  $sum * .10;?>)</td>
              </tr>
              <tr>
                <td>Grand Total </td>
                 <td>: </td>
                <td>TK.<?php
                   $vat = $sum * .10;
                   $gtotal = $vat + $sum;
                   echo $gtotal;
                   ?> </td>
              </tr>
              <tr>
                <td>Quentity  </td>
                 <td>: </td>
                <td><?php echo $qut;?></td>
              </tr>
             </table>
           <?php }?>
        </div>
        <div class="division">
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
  <div class="order"><a href="?orderid=order">Order</a></div>
	</div>
  <?php include 'inc/footer.php'?>