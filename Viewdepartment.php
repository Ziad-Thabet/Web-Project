<?php
include("adformheader.php");
include("dbconnection.php");
if(isset($_GET['delid']))
{
	$sql ="DELETE FROM department WHERE departmentid='$_GET[delid]'";
	$query=mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>
    Swal.fire({
      title: 'Done!',
      text: 'department deleted successfully',
      type: 'success',
      
    })</script>";
  }
}
?>


<div class="container-fluid">
  <div class="block-header">
    <h2 class="text-center">View Department Record</h2>
    
  </div>
  <div class="card">
    
    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <tbody>
        <tr>
          <td><strong>Name</strong></td>
          <td><strong>Department Description</strong></td>          
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
        $sql ="SELECT * FROM department";
        $query = mysqli_query($con,$sql);
        while($SelectDepartment = mysqli_fetch_array($query))
        {
          echo "<tr>
          <td>$SelectDepartment[departmentname]</td>
          <td> $SelectDepartment[description]</td>
          
          <td>&nbsp;$SelectDepartment[status]</td>";
          if(isset($_SESSION['adminid']))
          {
            echo "<td>&nbsp;
            <a href='department.php?editid=$SelectDepartment[departmentid]'>Edit</a> | <a href='viewdepartment.php?delid=$SelectDepartment[departmentid]'>Delete</a> </td>";
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