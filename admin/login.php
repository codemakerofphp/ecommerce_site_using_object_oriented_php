<?php include '../classess/adminlogin.php' ?>
<?php
$al = new Adminlogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$adminuser = $_POST['adminUser'];
	$adminpass = md5($_POST['adminPass']);

	$logincheck = $al -> adminlogin($adminuser,$adminpass);

}
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Admin Login</h1>
			<?php
			if (isset($logincheck)) {
			 	echo $logincheck;
			 } 
			?>
			<div>
				<input type="text" placeholder="Username"  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>