<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM patient WHERE patientid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('patient record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Patient Report</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

      <thead>
        <tr>
          <th width="15%" height="36"><div align="center">Name</div></th>
          <th width="20%"><div align="center">Admission</div></th>
          <th width="28%"><div align="center">Address, Contact</div></th>    
          <th width="20%"><div align="center">Patient Profile</div></th>
          <th width="17%"><div align="center">Action</div></th>
        </tr>
      </thead>
      <tbody>
       <?php
              $sql ="SELECT * FROM patient";
              $query = mysqli_query($con,$sql);
              while($SelectPatient = mysqli_fetch_array($query))
              {
                echo "<tr>
                <td>$SelectPatient[patientname]<br>
                <strong>Login ID :</strong> $SelectPatient[loginid] </td>
                <td>
                <strong>Date</strong>: &nbsp;$SelectPatient[admissiondate]<br>
                <strong>Time</strong>: &nbsp;$SelectPatient[admissiontime]</td>
                <td>$SelectPatient[address]<br>$SelectPatient[mobileno]</td>
                <td><strong>Gender</strong> - &nbsp;$SelectPatient[gender]<br>
                <strong>DOB</strong> - &nbsp;$SelectPatient[dob]</td>
                <td align='center'>Status - $SelectPatient[status] <br>";
                
                if(isset($_SESSION['QualityID'])||($_SESSION['adminid']))
                {
                  echo "<a href='patient.php?editid=$SelectPatient[patientid]' class='btn btn-sm btn-raised bg-green'>Edit</a><a href='viewpatient.php?delid=$SelectPatient[patientid]' class='btn btn-sm btn-raised bg-blush'>Delete</a> <hr>";
                }
               
              }
              
      $sql1 ="SELECT * FROM appointment";
       $query1 = mysqli_query($con,$sql1);
       while($SelectAppointment = mysqli_fetch_array($query1))
       {
        if(isset($_SESSION['QualityID'])||($_SESSION['adminid'])||($_SESSION['doctorid']))
                {
                  echo " <a href='patientreport.php?patientid=$SelectAppointment[patientid]&appointmentid=$SelectAppointment[appointmentid]' class='btn btn-sm btn-raised bg-cyan'>View Report</a>";
                }
      }
      echo "</td></tr>";
      ?>
    </tbody>
  </table>
</section>

</div>
</div>
<?php
include("adformfooter.php");
?>