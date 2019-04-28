<?php include 'inc/header.php'?>
<?php
$login1 = Session::get("cuslogin");
if ($login1==true) {
	header("location:oredr.php");
}
?>
<?php
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
	$cuslogin = $cum -> customerlogin($_POST);
}
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<?php
        	if (isset($cuslogin)) {
        		echo $cuslogin;
        	}
        	?>
        	<form action="" method="post">
                	<input  type="text" name="email" placeholder="Enter Email">
                    <input  type="password" name="password" placeholder="Enter password">
                    <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>

                 </form>

           <?php
           if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['registration'])) {
           	$setdata = $cum -> customerregistration($_POST);
           }
           ?>         
    	<div class="register_account">
    		<?php
    		if (isset($setdata)) {
    			echo $setdata;
    		}
    		?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" >
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="zip">
							</div>
							<div>
								<input type="text" name="email" placeholder="email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="country">
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="phone">
		          </div>
				  
				  <div>
					<input type="password" name="password" placeholder="password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="registration">Create Account</button></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'?>
