<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/addcategory.php'; ?>

<?php
if (!isset($_GET['catid']) || $_GET['catid']==NULL) {
    header("location:catlist.php");
}else{
    $id = $_GET['catid'];
}

$ac = new addcategory();
if ($_SERVER['REQUEST_METHOD']=='POST') {
    $catname = $_POST['catname'];
    $catupdate = $ac -> catupdate($catname,$id);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
                <?php
                 if (isset($catupdate)) {
                     echo $catupdate;
                 }
                ?>
               <div class="block copyblock"> 
                
                 <form action="" method="post">
                    <table class="form">
                    <?php
                    $getcatlist = $ac -> getcat($id);
                    if ($getcatlist) {
                        while ($data=$getcatlist->fetch_assoc()) {
                            
                    
                    ?>					
                        <tr>
                            <td>
                                <input type="text" name="catname" value="<?php echo $data['categoryName']?>" class="medium" />
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