<?php
session_start();
include("dbconnection.php");




if(isset($_POST['submitapp']))
{
	$sql ="INSERT INTO appointment(appointmenttype,departmentid,appointmentdate,appointmenttime,doctorid) values('$_POST[select]','$_POST[select3]','$_POST[date]','$_POST[time]','$_POST[select5]')";
	if($query = mysqli_query($con,$sql))
	{
		echo "<script>alert('appointment record inserted successfully...');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}





if(isset($_GET['editid']))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$AppEdit = mysqli_fetch_array($query);
	
}

	$sqlappointment1 = "SELECT max(appointmentid) FROM appointment where patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
	$queryappointment1 = mysqli_query($con,$sqlappointment1);
	$SelectAppintment1=mysqli_fetch_array($queryappointment1);
	
	$sqlappointment = "SELECT * FROM appointment where appointmentid='$SelectAppintment1[0]'";
	$queryappointment = mysqli_query($con,$sqlappointment);
	$SelectAppintment=mysqli_fetch_array($queryappointment);
	
if(mysqli_num_rows($queryappointment) == 0)
{
	echo "<center><h2>No Appointment records found..</h2></center>";
}
else
{
	$sqlappointment = "SELECT * FROM appointment where appointmentid='$SelectAppintment1[0]'";
	$queryappointment = mysqli_query($con,$sqlappointment);
	$SelectAppintment=mysqli_fetch_array($queryappointment);

	$sqldepartment = "SELECT * FROM department where departmentid='$SelectAppintment[departmentid]'";
	$querydepartment = mysqli_query($con,$sqldepartment);
	$SelectDepartment =mysqli_fetch_array($querydepartment);

	$sqldoctor = "SELECT * FROM doctor where doctorid='$SelectAppintment[doctorid]'";
	$querydoctor = mysqli_query($con,$sqldoctor);
	$SelectDoctor =mysqli_fetch_array($querydoctor);
?>
<table class="table table-bordered table-striped">
	<tr>
		<td>Department</td>
		<td>&nbsp;<?php echo $SelectDepartment['departmentname']; ?></td>
	</tr>
	<tr>
		<td>Doctor</td>
		<td>&nbsp;<?php echo $SelectDoctor['doctorname']; ?></td>
	</tr>
	<tr>
		<td>Appointment Date</td>
		<td>&nbsp;<?php echo date("D-M-Y",strtotime($SelectAppintment['appointmentdate'])); ?></td>
	</tr>
	<tr>
		<td>Appointment Time</td>
		<td>&nbsp;<?php echo date("h:i A",strtotime($SelectAppintment['appointmenttime'])); ?></td>
	</tr>
	</table>
	<?php
	}
	?>
	<script type="application/javascript">








function validateform()
{
	
	if(document.frmappntdetail.select.value == "")
	{
		alert("Appointment type should not be empty..");
		document.frmappntdetail.select.focus();
		return false;
	}
	else if(document.frmappntdetail.select3.value == "")
	{
		alert("Department name should not be empty..");
		document.frmappntdetail.select3.focus();
		return false;
	}
	else if(document.frmappntdetail.date.value == "")
	{
		alert("Appointment date should not be empty..");
		document.frmappntdetail.date.focus();
		return false;
	}
	else if(document.frmappntdetail.time.value == "")
	{
		alert("Appointment time should not be empty..");
		document.frmappntdetail.time.focus();
		return false;
	}
	else if(document.frmappntdetail.select5.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmappntdetail.select5.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>