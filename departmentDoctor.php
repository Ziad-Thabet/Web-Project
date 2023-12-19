
<?php
session_start();
include("dbconnection.php");
$sql ="SELECT * FROM doctor WHERE departmentid='$_GET[deptid]'";
$query = mysqli_query($con,$sql);
echo "<select class='selectpicker' name='doct' id='doct'  >";
while($query1=mysqli_fetch_array($query))
{	
	echo "<option value=''>Select doctor</option>";
	echo "<option value='$query1[doctorid]'>$query1[doctorname]</option>";		
}
echo "</select>"
?>	          
