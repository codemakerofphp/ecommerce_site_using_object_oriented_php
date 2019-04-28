<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classess/addbrand.php'; ?>
<?php include '../classess/addcategory.php'; ?>
<?php include '../classess/product.php'; ?>

<?php
if (!isset($_GET['proid']) || $_GET['proid']==NULL) {
    header("location:productlist.php");
}else{
    $id = $_GET['proid'];
}

$pd = new product();
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
    $updatepro = $pd -> updatepro($_POST,$_FILES,$id);
}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product </h2>
        <div class="block"> 
        <?php
        if (isset($updatepro)) {
            echo "$updatepro";
        }

        ?>              

         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php
                $getprobyid = $pd -> getprodbyid($id); 
                if ($getprobyid) {
                    while ($data = $getprobyid -> fetch_assoc()) {
                        
                ?>
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $data['productName']?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="id">
                            <option>Select Category</option>
                            <?php
                            $cat = new addcategory();
                            $data1 = $cat->catlist();
                            if ($data) {
                                while ($res=$data1->fetch_assoc()) {
                        
                            ?>
                            <option
                             <?php
                              if ($data['Id']==$res['id']){
                              ?>
                               selected ="selected"
                                 <?php }?>
                             value="<?php echo $res['id']?>"> <?php echo $res['categoryName']?></option>
                            <?php 
                            }}else{
                                echo "data not found";
                            }

                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php
                            $ba = new brand();
                            $data1 = $ba->getbrand();
                            if ($data) {
                                while ($res=$data1->fetch_assoc()) {
                        
                            ?>
                            <option
                             <?php
                              if ($data['brandId']==$res['brandId']){
                              ?>
                               selected ="selected"
                                 <?php }?>
                             value="<?php echo $res['brandId']?>"> <?php echo $res['brandName']?></option>
                            <?php 
                            }}else{
                                echo "data not found";
                            }

                            ?>
                            
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body" <?php echo $data['body']?> ></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $data['price']?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $data['image']?>" height="80px" width="200px" >
                        <br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                             <?php
                            if ($data['type']=='0') { ?>
                                 <option selected="selected" value="0">Featured</option>
                                 <option value="1">Non-Featured</option>
                                
                            <?php }else{?>
                            <option selected="selected" value="1">Non-Featured</option>
                            <option value="0">Featured</option>
                        <?php }?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
        <?php }}?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


