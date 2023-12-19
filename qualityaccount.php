
<?php

include("adheader.php");
include 'dbconnection.php';

if(!isset($_SESSION['QualityID']))
{
	echo "<script>window.location='qualitylogin.php';</script>";
}

?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Welcome <?php  $sql="SELECT * FROM `qualitymanger` WHERE QualityID='$_SESSION[QualityID]' ";
    $query = mysqli_query($con,$sql);
    $quality = mysqli_fetch_array($query);

      echo 'Sir. '. $quality['QualityName'];
    ?>

  </h2>
</div>
</div>

<?php
include("adfooter.php");
?>