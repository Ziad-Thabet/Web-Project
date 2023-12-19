<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
			$sql ="UPDATE treatment_records SET appointmentid='$_POST[select2]',treatmentid='$_POST[select4]',patientid='$_POST[patientid]',doctorid='$_POST[select5]',treatment_description='$_POST[textarea]',treatment_date='$_POST[treatmentdate]',treatment_time='$_POST[treatmenttime]',status='Active' WHERE appointmentid='$_GET[editid]'";
		if($query = mysqli_query($con,$sql))
		{
			echo "<script>alert('treatment record updated successfully...');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}	
	}
	else
	{
		$sql ="INSERT INTO treatment_records(appointmentid,treatmentid,patientid,doctorid,treatment_description,treatment_date,treatment_time,status) values('$_POST[select2]','$_POST[select4]','$_POST[patientid]','$_POST[select5]','$_POST[textarea]','$_POST[treatmentdate]','$_POST[treatmenttime]','Active')";
		$query = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con)>=1)
		{
			echo "<script>alert('Treatment record inserted successfully...');</script>";
		}
	$doctorid= $_POST['select5'];
	
	$treatmentid= $_POST['select4'];
}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM treatment_records WHERE appointmentid='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$SelectTreatmentRecords = mysqli_fetch_array($query);
	
}
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Add New treatment records</h2>

  </div>

  <div class="card" style="padding: 10px">

    <form method="post" action="" name="frmtreatrec" onSubmit="return validateform()" enctype="multipart/form-data">
    <table class="table table-bordered table-striped">
      <tbody>
        <tr>
          <td width="40%">Appointment</td>
          <td width="60%">
          <input class="form-control" type="text" readonly name="select2" value="<?php echo $_GET['appid']; ?>"  /></td>
        </tr>
        <tr>
          <td>Patient</td>
          <td>
          <input class="form-control" type="hidden" name="patientid" value="<?php echo $_GET['patientid']; ?>" />
<?php
$sqlpatient= "SELECT * FROM patient WHERE status='Active' OR status='Aproved' AND patientid='$_GET[patientid]'";
$querypatientient = mysqli_query($con,$sqlpatient);
$SelectPatient=mysqli_fetch_array($querypatientient);
?>			
          <input class="form-control" type="text" readonly name="select3" value="<?php echo $SelectPatient['patientname']; ?>"  />
</td>
        </tr>
        
        <tr>
          <td>Select Treatment type</td>
          <td>          
          <select name="select4" id="select4" class="form-control show-tick">
           <option value="">Select</option>
            <?php
		  	$sqltreatment= "SELECT * FROM treatment WHERE status='Active'";
			$querytreatment = mysqli_query($con,$sqltreatment);
			while($SelectTreatment=mysqli_fetch_array($querytreatment))
			{
				if($SelectTreatment['treatmentid'] == $SelectTreatmentRecords['treatmentid'])
				{
				echo "<option value='$SelectTreatment[treatmentid]' selected>$SelectTreatment[treatmenttype]</option>";
				}
				else
				{
					echo "<option value='$SelectTreatment[treatmentid]'>$SelectTreatment[treatmenttype]</option>";
				}
				
			}
		  ?>
 </select></td>
        </tr>
        
        
        <?php
		if(isset($_SESSION['doctorid']))
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active' AND doctor.doctorid='$_SESSION[doctorid]'";
				$querydoctor = mysqli_query($con,$sqldoctor);
				while($SelectDoctor = mysqli_fetch_array($querydoctor))
				{
					echo "$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] )";
				}
				?>
                <input class="form-control" type="hidden" name="select5" value="<?php echo $_SESSION['doctorid']; ?>"  />
          </td>
        <?php
		}
		else
		{
		?>
        <tr>
          <td>Doctor</td>
          <td>
          <select name="select5" id="select5">
    		<option value="">Select</option>
    		<?php
				$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
				$querydoctor = mysqli_query($con,$sqldoctor);
				while($SelectDoctor = mysqli_fetch_array($querydoctor))
				{
					if($SelectDoctor['doctorid'] == $SelectTreatmentRecords['doctorid'])
					{
					echo "<option value='$SelectDoctor[doctorid]' selected>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] ) </option>";
					}
					else
					{
					echo "<option value='$SelectDoctor[doctorid]'>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] )</option>";				
					}
				}
		  		?>
          	</select>
          </td>
        <?php
		}
		?>
          
       
        </tr>
        <tr>
          <td>Treatment Description</td>
          <td><input class="form-control" name="textarea" id="textarea" cols="45" rows="5"><?php echo $SelectTreatmentRecords['treatment_description'] ; ?></textarea></td>
        </tr>
        <tr>
          <td>Treatment date</td>
          <td><input class="form-control" type="date" max="<?php echo date("Y-m-d"); ?>" name="treatmentdate" id="treatmentdate" value="<?php echo $SelectTreatmentRecords['treatment_date']; ?>" /></td>
         
        </tr>
        <tr>
          <td>Treatment Time</td>
          <td><input class="form-control" type="time" name="treatmenttime" id="treatmenttime" value="<?php echo $SelectTreatmentRecords['treatment_time']; ?>" /></td>
        </tr>

        <tr>
          <td colspan="2" align="center"><input class="form-control" type="submit" name="submit" id="submit" value="Submit" /> | <a href='patientreport.php?patientid=<?php echo $_SESSION['patientid']; ?>&appointmentid=<?php echo $_GET['appointmentid']; ?>'><strong>View Patient Report>></strong></a></td>
        </tr>
      </tbody>
    </table>
    </form>
    <p>&nbsp;</p>
          <table class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td width="71">Treatment type</td>
            <td width="78">Doctor</td>
            <td width="82">Treatment Description</td>
            <td width="43">Treatment date</td>
            <td width="43">Treatment time</td>
            <td width="54">Status</td>
            <td width="58">Action</td>
          </tr>
          <?php
		$sql ="SELECT * FROM treatment_records WHERE patientid='$_GET[patientid]' AND appointmentid='$_GET[appid]' ";
		$query = mysqli_query($con,$sql);
		while($SelectTreatmentRecords = mysqli_fetch_array($query))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$SelectTreatmentRecords[patientid]'";
			$querypatient = mysqli_query($con,$sqlpat);
			$SelectPatient = mysqli_fetch_array($querypatient);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$SelectTreatmentRecords[doctorid]'";
			$querydoc = mysqli_query($con,$sqldoc);
			$SelectDoctor = mysqli_fetch_array($querydoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$SelectTreatmentRecords[treatmentid]'";
			$querytreatment = mysqli_query($con,$sqltreatment);
			$SelectTreatment = mysqli_fetch_array($querytreatment);
			
        echo "<tr>
          <td>&nbsp;$SelectTreatment[treatmenttype]</td>
		    <td>&nbsp;$SelectDoctor[doctorname]</td>
			<td>&nbsp;$SelectTreatmentRecords[treatment_description]</td>
			 <td>&nbsp;$SelectTreatmentRecords[treatment_date]</td>
			  <td>&nbsp;$SelectTreatmentRecords[treatment_time]</td>
			    <td>&nbsp;$SelectTreatmentRecords[status]</td>
          <td>&nbsp;
		  <a href='treatmentrecord.php?editid=$SelectTreatmentRecords[appointmentid]&patientid=$_GET[patientid]&appid=$_GET[appid]'>Edit</a>| <a href='treatmentrecord.php?delid=$SelectTreatmentRecords[appointmentid]&patientid=$_GET[patientid]&appointmentid=$_GET[appid]'>Delete</a> </td>
        </tr>";
		}
		?>
        </tbody>
      </table>
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
var numericExpression = /^[0-9]+$/; //Variable to validate only numbeApp
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbeApp and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if(document.frmtreatrec.select2.value == "")
	{
		alert("Appoitment ID should not be empty..");
		document.frmtreatrec.select2.focus();
		return false;
	}
	
	else if(document.frmtreatrec.select4.value == "")
	{
		alert("Treatment ID should not be empty..");
		document.frmtreatrec.select4.focus();
		return false;
	}
	else if(document.frmtreatrec.select3.value == "")
	{
		alert("Patient ID should not be empty..");
		document.frmtreatrec.select3.focus();
		return false;
	}
	else if(document.frmtreatrec.select5.value == "")
	{
		alert("Doctor ID should not be empty..");
		document.frmtreatrec.select5.focus();
		return false;
	}
	else if(document.frmtreatrec.textarea.value == "")
	{
		alert("Treatment Description should not be empty..");
		document.frmtreatrec.textarea.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmentdate.value == "")
	{
		alert("Treatment date should not be empty..");
		document.frmtreatrec.treatmentdate.focus();
		return false;
	}
	else if(document.frmtreatrec.treatmenttime.value == "")
	{
		alert("Treatment time should not be empty..");
		document.frmtreatrec.treatmenttime.focus();
		return false;
	}
	else if(document.frmtreatrec.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmtreatrec.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>