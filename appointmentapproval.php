<?php
include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
		if(isset($_GET['editid']))
		{
				$sql ="UPDATE patient SET status='Active' WHERE patientid='$_GET[patientid]'";
			$sql ="UPDATE appointment SET appointmenttype='$_POST[apptype]',departmentid='$_POST[select5]',doctorid='$_POST[select6]',status='Approved',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]' WHERE appointmentid='$_GET[editid]'";
			if($query = mysqli_query($con,$sql))
			{			
				echo "<script>alert('appointment record updated successfully...');</script>";				
				echo "<script>window.location='patientreport.php?patientid=$_GET[patientid]&appointmentid=$_GET[editid]';</script>";
			}
			else
			{
				echo mysqli_error($con);
			}	
		}
		else
		{
			$sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
			$query=mysqli_query($con,$sql);
				
			$sql ="INSERT INTO appointment(appointmenttype,patientid,departmentid,appointmentdate,appointmenttime,doctorid,status) values('$_POST[select2]','$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]')";
			if($query = mysqli_query($con,$sql))
			{
				echo "<script>alert('Appointment record inserted successfully...');</script>";
			}
			else
			{
				echo mysqli_error($con);
			}
		}
}
if(isset($_GET['editid']))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$SelectAppointment = mysqli_fetch_array($query);
	
}
?>


<div class="card ">
 
    <div class="block-header">
	<h2 class="text-center">Appointment Approval Process</h2>
	</div>
   <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
  
    <table class="table table-striped">                
        <tr>
          <td >Patient</td>
          <td >
            <?php
			if(isset($_GET['patientid']))
			{
				$sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
				$querypatient = mysqli_query($con,$sqlpatient);
				$SelectPatient=mysqli_fetch_array($querypatient);
				echo $SelectPatient['patientname'] . " (Patient ID - $SelectPatient[patientid])";
			}
			else
			{
				$sqlpatient= "SELECT * FROM patient WHERE status='Active'";
				$querypatient = mysqli_query($con,$sqlpatient);
				while($SelectPatient=mysqli_fetch_array($querypatient))
				{
					if($SelectPatient['patientid'] == $SelectAppointment['patientid'])
					{
					echo "<option value='$SelectPatient[patientid]' selected> $SelectPatient[patientname](Patient ID - $SelectPatient[patientid])</option>";
					}
				}
			}
		  ?>
      </td>
        </tr>

        <tr>
          <td>Department</td>
          <td><select name="select5" id="select5" class="form-control show-tick">
           <option value="">Select</option>
            <?php
		  	$sqldepartment= "SELECT * FROM department WHERE status='Active'";
			$querydepartment = mysqli_query($con,$sqldepartment);
			while($SelectDepartment=mysqli_fetch_array($querydepartment))
			{
				if($SelectDepartment['departmentid'] == $SelectAppointment['departmentid'])
				{
					echo "<option value='$SelectDepartment[departmentid]' selected>$SelectDepartment[departmentname]</option>";
				}
				else
				{
					echo "<option value='$SelectDepartment[departmentid]'>$SelectDepartment[departmentname]</option>";
				}
				
			}
		  ?>
          </select></td>
        </tr>
		
        <tr>
          <td>Doctor</td>
          <td><select name="select6" id="select6" class="form-control show-tick">
            <option value="">Select</option>
            <?php
          	$sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
			$querydoctor = mysqli_query($con,$sqldoctor);
			while($SelectDoctor = mysqli_fetch_array($querydoctor))
			{
				if($SelectDoctor['doctorid'] == $SelectAppointment['doctorid'])
				{
					echo "<option value='$SelectDoctor[doctorid]' selected>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] ) </option>";
				}
				else
				{
					echo "<option value='$SelectDoctor[doctorid]'>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] )</option>";				
				}
			}
		  ?>
          </select></td>
        </tr>
		
        <tr>
			<td>Appointment Date</td>
			<td><input class="form-control" type="date" name="appointmentdate" id="appointmentdate" value="<?php echo $SelectAppointment['appointmentdate']; ?>" /></td>
        </tr>
        <tr>
			<td>Appointment Time</td>
			<td><input class="form-control" type="time" name="time" id="time" value="<?php echo $SelectAppointment['appointmenttime']; ?>" /></td>
        </tr>
        <tr>
			<td>Appointment reason</td>
			<td><input class="form-control" name="appreason" id="appreason" value="<?php echo $SelectAppointment['app_reason']; ?>"/></td>         
        </tr>
        <tr>
        <td colspan="2" align="center"><input class="btn btn-default" type="submit" name="submit" id="submit" value="Submit" /></td>
        </tr>
	</tbody>
    </table>
    </form>
    <p>&nbsp;</p>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<?php
include("adfooter.php");
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmappnt.select4.value == "")
	{
		alert("Patient name should not be empty..");
		document.frmappnt.select4.focus();
		return false;
	}
	else if(document.frmappnt.select5.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappnt.select5.focus();
		return false;
	}
	else if(document.frmappnt.appointmentdate.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappnt.appointmentdate.focus();
		return false;
	}
	else if(document.frmappnt.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappnt.time.focus();
		return false;
	}
	else if(document.frmappnt.select6.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappnt.select6.focus();
		return false;
	}
	else if(document.frmappnt.select.value == "" )
	{
		alert("Kindly select the status..");
		document.frmappnt.select.focus();
		return false;
	}
	else
	{
		return true;
	}
}
$('.out_patient').hide();
$('#apptype').change(function()
{
	apptype=$('#apptype').val();
	if(apptype=='InPatient')
	{
		$('.out_patient').show();
	}
	else
	{
		$('.out_patient').hide();
	}
});
</script>