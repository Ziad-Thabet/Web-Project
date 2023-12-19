<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM admin WHERE adminid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('admin record deleted successfully..');</script>";
	}
}
?>

<div class="container-fluid">
<div class="block-header">
		<h2 class="text-center"> View Admin </h2>
	</div>
</div>
<div class="card">
  <section class="container">
   <table class="table table-bordered table-striped table-hover js-basic-example dataTable">


    <thead>
      <tr>
        <td width="12%" height="40">Admin Name</td>
        <td width="11%">Login ID</td>
        <td width="12%">Status</td>
        <td width="10%">Action</td>
      </tr>
    </thead>
    <tbody>
     <?php
     $sql ="SELECT * FROM admin";
     $query = mysqli_query($con,$sql);
     while($SelectAdmin = mysqli_fetch_array($query))
     {
      echo "<tr>
      <td>$SelectAdmin[adminname]</td>
      <td>$SelectAdmin[loginid]</td>
      <td>$SelectAdmin[status]</td>
      <td>
      <a href='admin.php?editid=$SelectAdmin[adminid]' class='btn btn-raised g-bg-cyan'>Edit</a> <a href='viewadmin.php?delid=$SelectAdmin[adminid]' class='btn btn-raised g-bg-blush2'>Delete</a> </td>
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