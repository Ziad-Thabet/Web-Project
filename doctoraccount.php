
<?php

include("adheader.php");
include 'dbconnection.php';

if(!isset($_SESSION['doctorid']))
{
	echo "<script>window.location='doctorlogin.php';</script>";
}

?>
<div class="container-fluid">
  <div class="block-header">
    <h2>Welcome <?php  $sql="SELECT * FROM `doctor` WHERE doctorid='$_SESSION[doctorid]' ";
    $query = mysqli_query($con,$sql);
    $SelectDoctor = mysqli_fetch_array($query);

    echo 'Dr. '. $SelectDoctor['doctorname']; ?>

  </h2>
</div>
</div>





<div class="card">
  <section class="container">
    <div class="row clearfix" style="margin-top: 10px">
      <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-file-plus col-blue"></i> </div>
          <div class="content">
            <div class="text">New Appoiment</div>
            <div class="number"><?php
            $sql = "SELECT * FROM appointment WHERE `doctorid`= '$_SESSION[doctorid]' AND appointmentdate=' ".date("Y-m-d")."'";
            $query = mysqli_query($con,$sql);
            echo mysqli_num_rows($query);
            ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6" style="position: relative; left: 150px;">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-account col-cyan"></i> </div>
          <div class="content">
            <div class="text">Number of Patient</div>
            <div class="number"><?php
            $sql = "SELECT * FROM patient WHERE status='Active'";
            $query = mysqli_query($con,$sql);
            echo mysqli_num_rows($query);
            ?></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-6" style="position: relative; left: 300px;">
        <div class="info-box-4 hover-zoom-effect">
          <div class="icon"> <i class="zmdi zmdi-account-circle col-blush"></i> </div>
          <div class="content">
            <div class="text">Today's Appointment</div>
            <div class="number">
              <?php
              $sql = "SELECT * FROM appointment WHERE status='Approved' AND `doctorid`= '$_SESSION[doctorid]' AND appointmentdate=' ".date("Y-m-d")."'" ;
            $query = mysqli_query($con,$sql);
            echo mysqli_num_rows($query);
            ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>



<?php
include("adfooter.php");
?>