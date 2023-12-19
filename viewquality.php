<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM qualitymanger WHERE QualityID='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('QualityManger record deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
	<div class="block-header">
		<h2 class="text-center">View QualityManger</h2>

	</div>

<div class="card">

	<section class="container">
		<table class="table table-bordered table-striped table-hover js-basic-example dataTable">
			<thead>
				<tr>
					<td>Name</td>
					<td>Contact</td>
					<td>LoginID</td>
					<td>Status</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				
				<?php
				$sql ="SELECT * FROM qualitymanger";
				$query = mysqli_query($con,$sql);
				while($SelectQualityManger = mysqli_fetch_array($query))
				{
					echo "<tr>
					<td>&nbsp;$SelectQualityManger[QualityName]</td>
					<td>&nbsp;$SelectQualityManger[mobileno]</td>
					<td>&nbsp;$SelectQualityManger[loginid]</td>
					<td>$SelectQualityManger[status]</td>
					<td>&nbsp;
					<a href='quality.php?editid=$SelectQualityManger[QualityID]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a> <a href='viewquality.php?delid=$SelectQualityManger[QualityID]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a> </td>
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