<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM appointment WHERE appointmentid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
if(isset($_GET['approveid']))
{
	$sql ="UPDATE appointment SET status='Approved' WHERE appointmentid='$_GET[approveid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Appointment record Approved successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Appointment records</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

      <thead>
        <tr>
          <th>Patient Detail</th>
          <th>Date & Time</th>
          <th>Department</th>
          <th>Doctor</th>
          <th>Reason</th>
          <th>Status</th>
          <th><div align="center">Action</div></th>
        </tr>
        </thead>
        <tbody>
          <?php
		$sql ="SELECT * FROM appointment WHERE (status !='')";
		if(isset($_SESSION['patientid']))
		{
			$sql  = $sql . " AND patientid='$_SESSION[patientid]'";
		}
		$query = mysqli_query($con,$sql);
		while($Select = mysqli_fetch_array($query))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$Select[patientid]'";
			$querypat = mysqli_query($con,$sqlpat);
			$SelectPatient = mysqli_fetch_array($querypat);
			
			
			$sqldept = "SELECT * FROM department WHERE departmentid='$Select[departmentid]'";
			$querydept = mysqli_query($con,$sqldept);
			$SelectDepartment = mysqli_fetch_array($querydept);
		
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$Select[doctorid]'";
			$querydoc = mysqli_query($con,$sqldoc);
			$SelectDoctor = mysqli_fetch_array($querydoc);
        echo "<tr>
          <td>&nbsp;$SelectPatient[patientname]<br>&nbsp;$SelectPatient[mobileno]</td>		 
			 <td>&nbsp;" . date("d-M-Y",strtotime($Select['appointmentdate'])) . " &nbsp; " . date("H:i A",strtotime($Select['appointmenttime'])) . "</td> 
		    <td>&nbsp;$SelectDepartment[departmentname]</td>
			   <td>&nbsp;$SelectDoctor[doctorname]</td>
			    <td>&nbsp;$Select[app_reason]</td>
			    <td>&nbsp;$Select[status]</td>
          <td><div align='center'>";
		  if($Select['status'] != "Approved")
		  {
				  if(!(isset($_SESSION['patientid'])))
				  {
						  echo "<a href='appointmentapproval.php?editid=$Select[appointmentid]'>Approve</a><hr>";
				  }
				 echo "  <a href='viewappointment.php?delid=$Select[appointmentid]'>Delete</a>";
		  }
		  else
		  {
				echo "<a href='patientreport.php?patientid=$Select[patientid]&appointmentid=$Select[appointmentid]'>View Report</a>";
				echo "<br>";
				echo "  <a href='viewappointment.php?delid=$Select[appointmentid]'>Delete</a>";
		  }
		 echo "</center></td></tr>";
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