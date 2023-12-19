<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
    $Filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./images/ID/" . $Filename;
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE patient SET patientname='$_POST[patientname]',admissiondate='$_POST[admissiondate]',admissiontime='$_POST[admissiontme]',address='$_POST[address]',mobileno='$_POST[mobilenumber]',loginid='$_POST[loginid]',password='$_POST[password]',gender='$_POST[select3]',dob='$_POST[dateofbirth]',status='$_POST[select66]',IMG='$folder' WHERE patientid='$_GET[editid]'";
		if($query = mysqli_query($con,$sql))
		{
			echo "<script>alert('patient record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO patient(patientname,admissiondate,admissiontime,address,mobileno,loginid,password,gender,dob,status,IMG) values('$_POST[patientname]','$dt','$tim','$_POST[address]','$_POST[mobilenumber]','$_POST[loginid]','$_POST[password]','$_POST[select3]','$_POST[dateofbirth]','$_POST[select66]','$folder')";
        
        if($query = mysqli_query($con,$sql))
		{
            echo "<script>alert('patients record inserted successfully...');</script>";
			$InsertID= mysqli_insert_id($con);
			if(isset($_SESSION['adminid']))
			{
                echo "<script>window.location='appointment.php?patid=$InsertID';</script>";	
			}
			else
			{
                echo "<script>window.location='patientlogin.php';</script>";	
			}		
		}
		else
		{
            echo mysqli_error($con);
		}
        move_uploaded_file($tempname, $folder);
	}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM patient WHERE patientid='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$SelectPatient = mysqli_fetch_array($query);
	
}
?>


<div class="container-fluid">
    <div class="block-header">
        <h2 class="text-center">Patient Registration Panel</h2>

    </div>
    <div class="card">

        <form method="post" action="" name="frmpatient" onSubmit="return validateform()" style="padding: 10px" enctype="multipart/form-data">



            <div class="form-group"><label>Patient Name</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="patientname" id="patientname"
                        value="<?php echo $SelectPatient['patientname']; ?>" />
                </div>
            </div>

            <?php
			if(isset($_GET['editid']))
			{
				?>

            <div class="form-group"><label>Admission Date</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="admissiondate" id="admissiondate"
                        value="<?php echo $SelectPatient['admissiondate']; ?>" readonly />
                </div>
            </div>


            <div class="form-group"><label>Admission Time</label>
                <div class="form-line">
                    <input class="form-control" type="time" name="admissiontme" id="admissiontme"
                        value="<?php echo $SelectPatient['admissiontime']; ?>" readonly />
                </div>
            </div>

            <?php
			}
			?>
            <div class="form-group">
                <label>Address</label>
                <div class="form-line">
                    <input class="form-control " name="address" id="tinymce" value="<?php echo $SelectPatient['address']; ?>">
                </div>
            </div>

            <div class="form-group"><label>Mobile Number</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="mobilenumber" id="mobilenumber"
                        value="<?php echo $SelectPatient['mobileno']; ?>" />
                </div>
            </div>
            <div class="form-group"><label>Login ID</label>
                <div class="form-line">
                    <input class="form-control" type="text" name="loginid" id="loginid"
                        value="<?php echo $SelectPatient['loginid']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Password</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="password" id="password"
                        value="<?php echo $SelectPatient['password']; ?>" />
                </div>
            </div>


            <div class="form-group"><label>Confirm Password</label>
                <div class="form-line">
                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword"
                        value="<?php echo $SelectPatient['confirmpassword']; ?>" />
                </div>
            </div>
            

            <div class="form-group"><label>Gender</label>
                <div class="form-line"><select class="form-control show-tick" name="select3" id="select3">
                        <option value="">Select</option>
                        <?php
				$arr = array("MALE","FEMALE");
				foreach($arr as $val)
				{
					if($val == $SelectPatient['gender'])
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
            


            <div class="form-group"><label>Date Of Birth</label>
                <div class="form-line">
                    <input class="form-control" type="date" name="dateofbirth" max="<?php echo date("Y-m-d"); ?>"
                        id="dateofbirth" value="<?php echo $SelectPatient['dob']; ?>" />
                </div>
            </div>
            <div class="form-group"><label>Status</label>
                <div class="form-line"><select class="form-control show-tick" name="select66" id="select66">
                        <option value="">Select</option>
                        <?php
				$arr = array("Active","Inactive");
				foreach($arr as $val)
				{
					if($val == $SelectPatient['status'])
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
            <div class=""><label>Image-ID</label>
            <div class="form-line">
				<input class="form-control" type="file" name="uploadfile" value="<?php echo $SelectPatient['IMG']; ?>" required/>
                </div>
			</div>


            <input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" />




        </form>
        <p>&nbsp;</p>
    </div>
</div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
include("adformfooter.php");
?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform(){
    if (document.frmpatient.patientname.value == "") {
        alert("Patient name should not be empty..");
        document.frmpatient.patientname.focus();
        return false;
    } else if (!document.frmpatient.patientname.value.match(alphaspaceExp)) {
        alert("Patient name not valid..");
        document.frmpatient.patientname.focus();
        return false;
    } else if (document.frmpatient.admissiondate.value == "") {
        alert("Admission date should not be empty..");
        document.frmpatient.admissiondate.focus();
        return false;
    } else if (document.frmpatient.admissiontme.value == "") {
        alert("Admission time should not be empty..");
        document.frmpatient.admissiontme.focus();
        return false;
    } else if (document.frmpatient.address.value == "") {
        alert("Address should not be empty..");
        document.frmpatient.address.focus();
        return false;
    } else if (document.frmpatient.mobilenumber.value == "") {
        alert("Mobile number should not be empty..");
        document.frmpatient.mobilenumber.focus();
        return false;
    } else if (!document.frmpatient.mobilenumber.value.match(numericExpression)) {
        alert("Mobile number not valid..");
        document.frmpatient.mobilenumber.focus();
        return false;
    } else if (document.frmpatient.loginid.value == "") {
        alert("Login ID should not be empty..");
        document.frmpatient.loginid.focus();
        return false;
    } else if (!document.frmpatient.loginid.value.match(alphanumericExp)) {
        alert("Login ID not valid..");
        document.frmpatient.loginid.focus();
        return false;
    } else if (document.frmpatient.password.value == "") {
        alert("Password should not be empty..");
        document.frmpatient.password.focus();
        return false;
    } else if (document.frmpatient.password.value.length < 8) {
        alert("Password length should be more than 8 characters...");
        document.frmpatient.password.focus();
        return false;
    } else if (document.frmpatient.password.value != document.frmpatient.confirmpassword.value) {
        alert("Password and confirm password should be equal..");
        document.frmpatient.confirmpassword.focus();
        return false;
    } else if (document.frmpatient.select3.value == "") {
        alert("Gender should not be empty..");
        document.frmpatient.select3.focus();
        return false;
    } else if (document.frmpatient.dateofbirth.value == "") {
        alert("Date Of Birth should not be empty..");
        document.frmpatient.dateofbirth.focus();
        return false;
    } else if (document.frmpatient.uploadfile.value == "") {
        alert("ID-Image should not be empty..");
        document.frmpatient.uploadfile.focus();
        return false;
    } else if (document.frmpatient.select.value == "") {
        alert("Kindly select the status..");
        document.frmpatient.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>