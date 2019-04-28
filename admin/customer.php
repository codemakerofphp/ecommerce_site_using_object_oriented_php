<?php include 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../classess/customer.php');

?>

<?php
if (!isset($_GET['cusid']) || $_GET['cusid']==NULL) {
    header("location:inbox.php");
}else{
    $id = $_GET['cusid'];
}

$cus = new customer();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    echo "<script>window.location = 'inbox.php'; </script>";
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Address</h2>
                
               <div class="block copyblock"> 
                
                 <form action="" method="post">
                    <table class="form">
                    <?php
                    $getcusaddr = $cus -> getcusalldata1($id);
                    if ($getcusaddr) {
                        while ($data=$getcusaddr->fetch_assoc()) {
                            
                    
                    ?>					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['name']?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['email']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['phone']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['city']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['zip']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['address']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <input type="text"  readonly="readonly" name="catname" value="<?php echo $data['country']?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="OK" />
                            </td>
                        </tr>
                    <?php }}?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>