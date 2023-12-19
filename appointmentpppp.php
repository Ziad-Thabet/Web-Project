<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
  if(isset($_SESSION['editid']))
  {
   $sql = "UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='Inactive' WHERE appointmentid='$_SESSION[editid]'";
   if($query = mysqli_query($con,$sql))
    {
    echo "<script>alert('appointment record updated successfully...');</script>";
}
else
{
    echo mysqli_error($con);
}	
}
else
{
   $sql ="UPDATE patient SET status='Active' WHERE patientid='$_POST[select4]'";
   $query=mysqli_query($con,$sql);

   $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','Inactive','$_POST[appreason]')";
   if($query = mysqli_query($con,$sql))
   {

    echo "<script>alert('Appointment record inserted successfully...');</script>";
    echo "<script>window.location='patientaccount.php?patientid=$_POST[select4]';</script>";
}
else
{
    echo mysqli_error($con);
}
}
}
if(isset($_SESSION['editid']))
{
	$sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
	$query = mysqli_query($con,$sql);
	$SelectAppiontment = mysqli_fetch_array($query);
	
}
?>
<div class="container-fluid">
<div class="block-header">
        <h2 class="text-center">Book Appointment</h2>
    </div>
<div class="row clearfix">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

  <div class="header">
    <h2>Appointment Information</h2>

  </div>

  <div class="card">

    <form method="post" action=""  name="frmpatapp" onSubmit="return validateform()" class="appointment-form">
    <input type="hidden" name="select2" value="Offline">
    <div class="body">

    <table class="table table-bordered table-striped">
      <tbody>
      <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <?php
                                        if(isset($_GET['patientid']))
                                        {
                                            $sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patientid]'";
                                            $querypatient = mysqli_query($con,$sqlpatient);
                                            $SelectPatient=mysqli_fetch_array($querypatient);
                                            echo $SelectPatient['patientname'];
                                            echo "<input type='hidden' name='select4' value='$SelectPatient[patientid]'>";
                                        }
                                        else
                                        {
                                        ?>

                                        <?php
                                 }
                                 ?>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select5" id="select5" class=" form-control show-tick">
                                            <option value="">Select Department</option>
                                            <?php
                                    $sqldepartment= "SELECT * FROM department WHERE status='Active'";
                                    
                                    $querydepartment = mysqli_query($con,$sqldepartment);
                                    while($SelectDepartment=mysqli_fetch_array($querydepartment)){
                                        if($SelectDepartment['departmentid'] == $SelectAppiontment['departmentid']){
                                        echo "<option value='$SelectDepartment[departmentid]' selected>$SelectDepartment[departmentname]</option>";
                                    }
                                    else{
                                        echo "<option value='$SelectDepartment[departmentid]'>$SelectDepartment[departmentname]</option>";
                                    }
                                    }
                                ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
        
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <select name="select6" id="select6" class=" form-control show-tick">
                                            <option value="">Select Doctor</option>
                                            <?php
                                $sqldoctor= "SELECT * FROM doctor INNER JOIN department ON department.departmentid=doctor.departmentid WHERE doctor.status='Active'";
                                $querydoctor = mysqli_query($con,$sqldoctor);
                                while($AddDoctor = mysqli_fetch_array($querydoctor))
                                {
                                    if($AddDoctor['doctorid'] == $SelectAppiontment['doctorid']){
                                    echo "<option value='$AddDoctor[doctorid]' selected>$AddDoctor[doctorname] ( $AddDoctor[departmentname] ) </option>";
                                    }
                                else{
                                    echo "<option value='$AddDoctor[doctorid]'>$AddDoctor[doctorname] ($AddDoctor[departmentname] )</option>";				
                                }
                            }
                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>
                                                <input class="form-control"  placeholder="Appointment Date" class="ion-ios-clock" type="text" onfocus="(this.type='date')" name="appointmentdate" id="appointmentdate"
                                                    value="<?php echo $SelectAppiontment['appointmentdate']; ?>" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label>
                                                <input class="form-control"  placeholder="Appointment time" class="ion-ios-clock" type="text" onfocus="(this.type='time')" name="time" id="time"
                                                    value="<?php echo $SelectAppiontment['appointmenttime']; ?>" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea rows="4" placeholder="Appointment Reason" class="form-control no-resize" name="appreason"
                                            id="appreason" s><?php echo $SelectAppiontment['app_reason']; ?></textarea>
                                    </div>
                                </div>
                            </div>

        <tr>
            
            <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit" value="Submit"/>
        </tr>
        </tbody>
    </table>
    </div>
    </form>
  </div>
</div>
</div>
</div>








<?php include 'adfooter.php'; ?>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform() {
    if (document.frmappnt.select4.value == "") {
        alert("Patient name should not be empty..");
        document.frmappnt.select4.focus();
        return false;
    }  else if (document.frmappnt.select5.value == "") {
        alert("Department name should not be empty..");
        document.frmappnt.select5.focus();
        return false;
    } else if (document.frmappnt.appointmentdate.value == "") {
        alert("Appointment date should not be empty..");
        document.frmappnt.appointmentdate.focus();
        return false;
    } else if (document.frmappnt.time.value == "") {
        alert("Appointment time should not be empty..");
        document.frmappnt.time.focus();
        return false;
    } else if (document.frmappnt.select6.value == "") {
        alert("Doctor name should not be empty..");
        document.frmappnt.select6.focus();
        return false;
    } else if (document.frmappnt.select.value == "") {
        alert("Kindly select the status..");
        document.frmappnt.select.focus();
        return false;
    } else {
        return true;
    }
}
</script>