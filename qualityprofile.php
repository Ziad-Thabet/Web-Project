<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['QualityID']))
	{
			$sql ="UPDATE QualityManger SET QualityName='$_POST[QualityName]',mobileno='$_POST[mobilenumber]',loginid='$_POST[loginid]',password='$_POST[password]',status='$_POST[select]' WHERE QualityID='$_SESSION[QualityID]'";
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
if(isset($_SESSION['QualityID']))
{
	$sql="SELECT * FROM QualityManger WHERE QualityID='$_SESSION[QualityID]' ";
	$query = mysqli_query($con,$sql);
	$Selectqualitymanger = mysqli_fetch_array($query);
	
}
?>
<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center"> Quality's Profile</h2>
    </div>
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">

                <form method="post" action="" name="frmdoctprfl" onSubmit="return validateform()" style="padding: 10px">
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Quality Name</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="QualityName" id="QualityName"
                                        value="<?php echo $Selectqualitymanger['QualityName']; ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                                        value="<?php echo $Selectqualitymanger['mobileno']; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <label>Login ID</label>
                                <div class="form-line">
                                    <input class="form-control" type="text" name="loginid" id="loginid"
                                        value="<?php echo $Selectqualitymanger['loginid']; ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-xs-12">

                            <input class="btn btn-raised" type="submit" name="submit" id="submit" value="Submit" />
                        </div>
                    </div>

                </form>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
    <div class="clear"></div>
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

function validateform() {
    if (document.frmdoctprfl.QualityName.value == "") {
        alert("QualityManger name should not be empty..");
        document.frmdoctprfl.QualityName.focus();
        return false;
    } else if (!document.frmdoctprfl.QualityName.value.match(alphaspaceExp)) {
        alert("QualityManger name not valid..");
        document.frmdoctprfl.QualityName.focus();
        return false;
    } else if (document.frmdoctprfl.mobilenumber.value == "") {
        alert("Mobile number should not be empty..");
        document.frmdoctprfl.mobilenumber.focus();
        return false;
    } else if (!document.frmdoctprfl.mobilenumber.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmdoctprfl.mobilenumber.focus();
        return false;
    } else if (document.frmdoctprfl.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmdoctprfl.loginid.focus();
        return false;
    } else if (!document.frmdoctprfl.loginid.value.match(alphanumericExp)) {
        alert("loginid not valid..");
        document.frmdoctprfl.loginid.focus();
        return false;
    } else if (document.frmdoctprfl.password.value == "") {
        alert("Password should not be empty..");
        document.frmdoctprfl.password.focus();
        return false;
    } else if (document.frmdoctprfl.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmdoctprfl.password.focus();
        return false;
    } else if (document.frmdoctprfl.password.value != document.frmdoctprfl.cnfirmpassword.value) {
        alert("Password and confirm password should be equal..");
        document.frmdoctprfl.password.focus();
        return false;
    } 
    else if (document.frmdoctprfl.select.value == "") {
        alert("Kindly select the status..");
        document.frmdoctprfl.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>