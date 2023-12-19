<?php
session_start();
include("dbconnection.php");
?>
		
<table class="table table-bordered table-striped">
          <tr>
            <td><strong>Treatment type</strong></td>
            <td><strong>Treatment date & time</strong></td>
            <td><strong>Doctor</strong></td>
            <td><strong>Treatment Description</strong></td>
          </tr>
          <?php
		 $sql ="SELECT * FROM treatment_records LEFT JOIN treatment ON treatment_records.treatmentid=treatment.treatmentid WHERE treatment_records.patientid='$_GET[patientid]' AND treatment_records.appointmentid='$_GET[appointmentid]'";
		$query = mysqli_query($con,$sql);
		while($App = mysqli_fetch_array($query))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$App[patientid]'";
			$querypat = mysqli_query($con,$sqlpat);
			$SelectPatient = mysqli_fetch_array($querypat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$App[doctorid]'";
			$querydoc = mysqli_query($con,$sqldoc);
			$SelectDoctor = mysqli_fetch_array($querydoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$App[treatmentid]'";
			$querytreatment = mysqli_query($con,$sqltreatment);
			$SelectTreatment = mysqli_fetch_array($querytreatment);
				
			echo "<tr>
					<td>&nbsp;$SelectTreatment[treatmenttype]</td>
					</td><td>&nbsp;" . date("d-m-Y",strtotime($App['treatment_date'])). "  &nbsp;". date("h:i A",strtotime($App['treatment_time'])) . "</td>
					<td>&nbsp;$SelectDoctor[doctorname]</td>
					<td>&nbsp;$App[treatment_description]";
		}
		?>
</table>
<?php
if(isset($_SESSION['doctorid']))
{
?>  
<hr>
	<table>
	<tr>
	<td>
		<div align="center">
			<strong>
				<a href="treatmentrecord.php?patientid=<?php echo $_GET['patientid']; ?>&appid=<?php echo $_GET['appointmentid']; ?>">Add Treatment records</a>
			</strong>
		</div>
	</td>
	</tr>
	</table>
<?php
}
?>
<script type="application/javascript">
function validateform()
{
	if(document.frmtreatdetail.select.value == "")
	{
		alert("Treatment name should not be empty..");
		document.frmtreatdetail.select.focus();
		return false;
	}
	
	else if(document.frmtreatdetail.select2.value == "")
	{
		alert("Doctor name should not be empty..");
		document.frmtreatdetail.select2.focus();
		return false;
	}
	else if(document.frmtreatdetail.textarea.value == "")
	{
		alert(" Treatment description should not be empty..");
		document.frmtreatdetail.textarea.focus();
		return false;
	}
	else if(document.frmtreatdetail.treatmentfile.value == "")
	{
		alert("Upload file should not be empty..");
		document.frmtreatdetail.treatmentfile.focus();
		return false;
	}
	else if(document.frmtreatdetail.date.value == "")
	{
		alert("Treatment date should not be empty..");
		document.frmtreatdetail.date.focus();
		return false;
	}
	else if(document.frmtreatdetail.time.value == "")
	{
		alert("Treatment time should not be empty..");
		document.frmtreatdetail.time.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>
