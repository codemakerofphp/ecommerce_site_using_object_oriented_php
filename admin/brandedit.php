<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/addbrand.php'; ?>

<?php
if (!isset($_GET['brandid']) || $_GET['brandid']==NULL) {
    header("location:brandlist.php");
}else{
    $id = $_GET['brandid'];
}

$brand = new brand();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $brandname = $_POST['brandname'];
    $brandupdate = $brand -> brandupdate($brandname,$id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
                <?php
                 if (isset($brandupdate)) {
                     echo $brandupdate;
                 }
                ?>
               <div class="block copyblock"> 
                
                 <form action="" method="post">
                    <table class="form">
                    <?php
                    $brandlist = $brand -> brandlist($id);
                    if ($brandlist) {
                        while ($data=$brandlist->fetch_assoc()) {
                            
                    
                    ?>					
                        <tr>
                            <td>
                                <input type="text" name="brandname" value="<?php echo $data['brandName']?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    <?php }}?>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>