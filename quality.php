<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE QualityManger SET QualityName='$_POST[QualityName]',mobileno='$_POST[mobilenumber]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]' WHERE QualityID='$_GET[editid]'";
		if($query = mysqli_query($con,$sql))
		{
			echo "<script>alert('QualityManger record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
	$sql ="INSERT INTO QualityManger(QualityName,mobileno,loginid,password,status) values('$_POST[QualityName]','$_POST[mobilenumber]','$_POST[loginid]','$_POST[password]','Active')";
	if($query = mysqli_query($con,$sql))
	{
		echo "<script>alert('QualityManger record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM QualityManger WHERE QualityID='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$Selectqualitymanger = mysqli_fetch_array($query);
	
}
?>

<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center"> Add New QualityManger </h2>
	</div>
	<div class="row clearfix">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">


				<form method="post" action="" name="frmdoct" onSubmit="return validateform()" style="padding: 10px">


					
					<div class="form-group"><label>Quality Name</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="QualityName" id="QualityName" value="<?php echo $Selectqualitymanger['QualityName']; ?>" />
				</div>
				</div>


					<div class="form-group"><label>Mobile Number</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="mobilenumber" id="mobilenumber" value="<?php echo $Selectqualitymanger['mobileno']; ?>"/>
				</div>
				</div>
					<div class="form-group"><label>Login ID</label> 
					<div class="form-line">
					<input class="form-control" type="text" name="loginid" id="loginid" value="<?php echo $Selectqualitymanger['loginid']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Password</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="password" id="password" value="<?php echo $Selectqualitymanger['password']; ?>"/>
				</div>
				</div>


					<div class="form-group"><label>Confirm Password</label> 
					<div class="form-line">
					<input class="form-control" type="password" name="cnfirmpassword" id="cnfirmpassword" value="<?php echo $Selectqualitymanger['password']; ?>"/>
				</div>
				</div>
					<div class="form-group">
					<label>Status</label> 
					<div class="form-line">
					<select class="form-control show-tick" name="select" id="select">
						<option value="" selected="" hidden>Select</option>
						<?php
						$arr= array("Active","Inactive");
						foreach($arr as $val)
						{
							if($val == $Selectqualitymanger['status'])
							{
								echo "<option value='$val' selected>$val</option>";
							}
							else
							{
								echo "<option value='$val'>$val</option>";
							}
						}
						?>
					</select>
				</div>
				</div>


					
					<input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />
				


				</form>
			</div>
		</div>
	</div>
</div>
<?php
include("adfooter.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmdoct.QualityName.value == "")
	{
		alert("QualityManger name should not be empty..");
		document.frmdoct.QualityName.focus();
		return false;
	}
	else if(!document.frmdoct.QualityName.value.match(alphaspaceExp))
	{
		alert("QualityManger name not valid..");
		document.frmdoct.QualityName.focus();
		return false;
	}
	else if(document.frmdoct.mobilenumber.value == "")
	{
		alert("Mobile number should not be empty..");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(!document.frmdoct.mobilenumber.value.match(numericExpression))
	{
		alert("Mobile number not valid..");
		document.frmdoct.mobilenumber.focus();
		return false;
	}
	else if(document.frmdoct.loginid.value == "")
	{
		alert("loginid should not be empty..");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(!document.frmdoct.loginid.value.match(alphanumericExp))
	{
		alert("loginid not valid..");
		document.frmdoct.loginid.focus();
		return false;
	}
	else if(document.frmdoct.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.password.value != document.frmdoct.cnfirmpassword.value )
	{
		alert("Password and confirm password should be equal..");
		document.frmdoct.password.focus();
		return false;
	}
	else if(document.frmdoct.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmdoct.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>