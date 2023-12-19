<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM doctor WHERE doctorid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('doctor record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">View Available Doctor</h2>

	</div>

<div class="card">

	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
			<thead>
				<tr>
					<td>Name</td>
					<td>Contact</td>
					<td>Department</td>
					<td>LoginID</td>
					<td>Education</td>
					<td>Experience</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				
				<?php
				$sql ="SELECT * FROM doctor";
				$query = mysqli_query($con,$sql);
				while($Select = mysqli_fetch_array($query))
				{

					$sqldept = "SELECT * FROM department WHERE departmentid='$Select[departmentid]'";
					$queryDepartment = mysqli_query($con,$sqldept);
					$SelectDepartment = mysqli_fetch_array($queryDepartment);
					echo "<tr>
					<td>&nbsp;$Select[doctorname]</td>
					<td>&nbsp;$Select[mobileno]</td>
					<td>&nbsp;$SelectDepartment[departmentname]</td>
					<td>&nbsp;$Select[loginid]</td>
					<td>&nbsp;$Select[education]</td>
					<td>&nbsp;$Select[experience] year</td>
					<td>$Select[status]</td>
					<td>&nbsp;
					<a href='doctor.php?editid=$Select[doctorid]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a> <a href='viewdoctor.php?delid=$Select[doctorid]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a> </td>
					</tr>";
				}
				?>      </tbody>
			</table>
		</section>
	</div>
</div>
	<?php
	include("adformfooter.php");
	?>