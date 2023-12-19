<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM treatment WHERE treatmentid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('treatment deleted successfully..');</script>";
	}
}
?>


<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Available Treatments</h2>

  </div>

  <div class="card">

    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <tbody>
        <tr>
          <td><strong>Treatment Type</strong></td>
          <td><strong>Note</strong></td>
          <td><strong>Status</strong></td>
          <?php
          if(isset($_SESSION['adminid']))
          {
            ?>
            <td><strong>Action</strong></td>
            <?php
          }
          ?>
        </tr>
        <?php
        $sql ="SELECT * FROM treatment";
        $query = mysqli_query($con,$sql);
        while($SelectTreatment = mysqli_fetch_array($query))
        {
          echo "<tr>
          <td>&nbsp;$SelectTreatment[treatmenttype]</td>
          <td>&nbsp;$SelectTreatment[note]</td>
          <td>&nbsp;$SelectTreatment[status]</td>";
          if(isset($_SESSION['adminid']))
          {
            echo "<td>&nbsp;
            <a href='treatment.php?editid=$SelectTreatment[treatmentid]' class='btn btn-raised bg-green'>Edit</a> 
            <a href='viewtreatment.php?delid=$SelectTreatment[treatmentid]' class='btn btn-raised bg-blush'>Delete</a> </td>";
          }
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