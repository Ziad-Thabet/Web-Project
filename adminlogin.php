<?php
session_start();
?>
<?php
error_reporting(0);
include("dbconnection.php");
$date = date("Y-m-d");
$time = date("H:i:s");
?>
<!-- header section -->
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Trex's Hospital Admin</title>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link href="assets/css/main.css" rel="stylesheet">
<link href="assets/css/login.css" rel="stylesheet">

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="assets/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-cyan login-page authentication">
<!-- header section -->

<?php
if(isset($_SESSION['adminid']))
{
	echo "<script>window.location='adminaccount.php';</script>";
}
$error='';
if(isset($_POST['submit']))
{	
	$sql = "SELECT * FROM admin WHERE loginid='$_POST[loginid]' AND password='$_POST[password]'";
	$query = mysqli_query($con,$sql);
	if(mysqli_num_rows($query) == 1)
	{
		$SelectAdminLogin = mysqli_fetch_array($query);
		$_SESSION['adminid']= $SelectAdminLogin['adminid'] ;
		echo "<script>window.location='adminaccount.php';</script>";
	}
	else
	{
		$error = "<div class='alert alert-danger'>
		<strong>Oh !</strong> Your username or password is wrong.
	</div>";
	}
}
		
?>


<div class="container">
	<div id = "error"><?php echo $error;
	
?></div>
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>Trex's Hospital</span>Login <span class="msg">Sign in to start your session</span></h1>
        <div class="col-md-12">

				<form method="post" action="" name="frmadminlogin" id="sign_in" onSubmit="return validateform()">
					<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
						<div class="form-line">
						<input type="text" name="loginid" id="loginid" class="form-control" placeholder="Username" /></div>
					</div>
					<div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
						<div class="form-line">
						<input type="password" name="password" id="password" class="form-control"  placeholder="Password" /> </div>
					</div>
					<div>
						<div class="">
							<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
							<label for="rememberme">Remember Me</label>
						</div>
						<div class="text-center">
						<input type="submit" name="submit" id="submit" value="Login" class="btn btn-raised waves-effect g-bg-cyan" /></div>
					</div>
            </form>
        </div>
    </div>    
</div>
 <div class="clear"></div>
 <div class="theme-bg"></div>
  </div>
</div>



<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
</body>
</html>









<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmadminlogin.loginid.value == "")
	{
		document.getElementById("error").innerHTML ="<div class='alert alert-info'><strong>Heads up!</strong> Please enter UserName</div>";
		document.frmadminlogin.loginid.focus();
		return false;
	}
	else if(!document.frmadminlogin.loginid.value.match(alphanumericExp))
	{
		document.getElementById("error").innerHTML ="<div class='alert alert-Warning'><strong>Heads up!</strong> Invalid UserName</div>";
		document.frmadminlogin.loginid.focus();
		return false;
	}
	else if(document.frmadminlogin.password.value == "")
	{
		document.getElementById("error").innerHTML ="<div class='alert alert-info'><strong>Heads up!</strong> Please enter Password</div>";
		document.frmadminlogin.password.focus();
		return false;
	}
	else if(document.frmadminlogin.password.value.length < 8)
	{
		document.getElementById("error").innerHTML ="<div class='alert alert-info'><strong>Heads up!</strong>Min Length should be 8</div>";
		document.frmadminlogin.password.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>