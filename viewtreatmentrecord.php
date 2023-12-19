<?php
include("adformheader.php");
include("dbconnection.php");
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
		<h2 class="text-center">View Treatment Report</h2>
	</div>

	<div class="card">
		<section class="container">
			<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
				<thead>
					<tr>
						<td width="71"	scope="col">Treatment type</td>
						<td width="52"	scope="col">Patient</td>
						<td width="78"	scope="col">Doctor</td>
						<td width="82"	scope="col">Treatment Description</td>
						<td width="43"	scope="col">Treatment date</td>
						<td width="43"	scope="col">Treatment time</td>
					</tr>
				</thead>
				<tbody>
					<?php
						$sql ="SELECT * FROM treatment_records where status='Active'";
						if(isset($_SESSION['patientid'])){
							$sql = $sql . " AND patientid='$_SESSION[patientid]'"; 
						}
						if(isset($_SESSION['doctorid'])){
							$sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
						}
						if(isset($_SESSION['QualityID'])){
							$sql = $sql . " AND QualityID='$_SESSION[QualityID]'";
						}
						$query = mysqli_query($con,$sql);
						while($Select = mysqli_fetch_array($query)){
							$sqlpat = "SELECT * FROM patient WHERE patientid='$Select[patientid]'";
							$querypat = mysqli_query($con,$sqlpat);
							$SelectPatient = mysqli_fetch_array($querypat);
							
							$sqldoc= "SELECT * FROM doctor WHERE doctorid='$Select[doctorid]'";
							$querydoc = mysqli_query($con,$sqldoc);
							$SelectDoctor = mysqli_fetch_array($querydoc);

							
							$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$Select[treatmentid]'";
							$querytreatment = mysqli_query($con,$sqltreatment);
							$SelectTreatment = mysqli_fetch_array($querytreatment);
							
						echo "<tr>
							<td>&nbsp;$SelectTreatment[treatmenttype]</td>
							<td>&nbsp;$SelectPatient[patientname]</td>
							<td>&nbsp;$SelectDoctor[doctorname]</td>
							<td>&nbsp;$Select[treatment_description]</td>
							<td>&nbsp;$Select[treatment_date]</td>
							<td>&nbsp;$Select[treatment_time]</td>";
						echo "</tr>";
						}
					?>
				</tbody>
			</table>
		</section>
	</div>
</div>
<?php
include("adformfooter.php");
?>