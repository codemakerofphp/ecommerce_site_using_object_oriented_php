<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/addbrand.php'; ?>

<?php
$bn = new brand();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $brandname = $_POST['brandname'];
    $brandn = $bn -> setbrand($brandname);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                <?php
                 if (isset($brandn)) {
                     echo $brandn;
                 }
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandname" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>