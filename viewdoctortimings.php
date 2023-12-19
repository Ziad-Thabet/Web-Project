<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM doctor_timings WHERE doctor_timings_id='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('doctortimings record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Doctor Timings</h2>

  </div>

<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-exportable dataTable" >
      <thead>
        <tr>
          <td>Doctor</td>
          <td>Timings available</td>
          <td>Status</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        
          <?php
		$sql ="SELECT * FROM doctor_timings where doctorid='$_SESSION[doctorid]'";
		$query = mysqli_query($con,$sql);
		while($Select = mysqli_fetch_array($query))
		{
			$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$Select[doctorid]'";
			$querydoctor = mysqli_query($con,$sqldoctor);
			$SelectDoctor = mysqli_fetch_array($querydoctor);
			
			$sqldoct = "SELECT * FROM doctor_timings WHERE doctor_timings_id='$Select[doctor_timings_id]'";
			$querydoct = mysqli_query($con,$sqldoct);
			$SelectDoctorTiming = mysqli_fetch_array($querydoct);
			
        echo "<tr>
          <td>&nbsp;$SelectDoctor[doctorname]</td>
          <td>&nbsp;$SelectDoctorTiming[start_time] - $SelectDoctorTiming[end_time]</td>
          <td>&nbsp;$Select[status]</td>
          <td width='250'>&nbsp;<a href='doctortimings.php?editid=$Select[doctor_timings_id]' class='btn btn-raised btn-sm g-bg-cyan'>Edit</a>  <a href='viewdoctortimings.php?delid=$Select[doctor_timings_id]' class='btn btn-raised btn-sm g-bg-blush2'>Delete</a> </td>
        </tr>";
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