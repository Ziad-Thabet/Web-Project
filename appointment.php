<?php

include("adheader.php");
include("dbconnection.php");
if(isset($_POST['submit']))
{
    if(isset($_GET['editid']))
    {
        $sql ="UPDATE appointment SET patientid='$_POST[select4]',departmentid='$_POST[select5]',appointmentdate='$_POST[appointmentdate]',appointmenttime='$_POST[time]',doctorid='$_POST[select6]',status='$_POST[select]' WHERE appointmentid='$_GET[editid]'";
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
            $query1=mysqli_query($con,$sql);

            $sql ="INSERT INTO appointment(patientid, departmentid, appointmentdate, appointmenttime, doctorid, status, app_reason) values('$_POST[select4]','$_POST[select5]','$_POST[appointmentdate]','$_POST[time]','$_POST[select6]','$_POST[select]','$_POST[appreason]')";
            if($query2 = mysqli_query($con,$sql))
            {

                echo "<script>alert('Appointment record inserted successfully...');</script>";
                echo "<script>window.location='patientreport.php?patientid=$_POST[select4]';</script>";
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    }
    if(isset($_GET['editid']))
    {
        $sql="SELECT * FROM appointment WHERE appointmentid='$_GET[editid]' ";
        $query3 = mysqli_query($con,$sql);
        $SelectApp = mysqli_fetch_array($query3);
        
    }
    ?>


    <div class="container-fluid">
        <div class="block-header">
            <h2 class="text-center">Book Appointment</h2>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Appointment Information </h2>

                    </div>
                    <form method="post" action="" name="frmappnt" onSubmit="return validateform()">
                        <input type="hidden" name="select2" value="Offline">
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <?php
                                            if(isset($_GET['patid']))
                                            {
                                                $sqlpatient= "SELECT * FROM patient WHERE patientid='$_GET[patid]'";
                                                $querypatient = mysqli_query($con,$sqlpatient);
                                                $SelectPatient=mysqli_fetch_array($querypatient);
                                                echo $SelectPatient['patientname'] . " (Patient ID - $SelectPatient[patientid])";
                                                echo "<input type='hidden' name='select4' value='$SelectPatient[patientid]'>";
                                            }
                                            else
                                            {
                                            ?>
                                            <select name="select4" id="select4" class=" form-control show-tick">
                                                <option value="">Select Patient</option>
                                                <?php
                                                $sqlpatient= "SELECT * FROM patient WHERE status='Active'";
                                                $querypatient = mysqli_query($con,$sqlpatient);
                                                while($SelectPatient=mysqli_fetch_array($querypatient))
                                                {
                                                    if($SelectPatient['patientid'] == $SelectApp['patientid'])
                                                    {
                                                    echo "<option value='$SelectPatient[patientid]' selected>$SelectPatient[patientid] - $SelectPatient[patientname]</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='$SelectPatient[patientid]'>$SelectPatient[patientid] - $SelectPatient[patientname]</option>";
                                                    }

                                                }
                                            ?>
                                            </select>
                                            <?php
                                    }
                                    ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select name="select5" id="select5" class=" form-control show-tick">
                                                <option value="">Select Department</option>
                                                <?php
                                                $sqldepartment= "SELECT * FROM department WHERE status='Active'";
                                                $querydepartment = mysqli_query($con,$sqldepartment);
                                                while($SelectDepart=mysqli_fetch_array($querydepartment)){
                                            if($SelectDepart['departmentid'] == $SelectApp['departmentid']){
                                            echo "<option value='$SelectDepart[departmentid]' selected>$SelectDepart[departmentname]</option>";
                                        }
                                        else{
                                            echo "<option value='$SelectDepart[departmentid]'>$SelectDepart[departmentname]</option>";
                                        }
                                        }
                                    ?>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="date" name="appointmentdate"
                                                id="appointmentdate" value="<?php echo $SelectApp['appointmentdate']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input class="form-control" type="time" name="time" id="time"
                                                value="<?php echo $SelectApp['appointmenttime']; ?>" />
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
                                            while($SelectDoctor = mysqli_fetch_array($querydoctor))
                                            {
                                                if($SelectDoctor['doctorid'] == $SelectApp['doctorid']){
                                                echo "<option value='$SelectDoctor[doctorid]' selected>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] ) </option>";
                                                }
                                            else{
                                                echo "<option value='$SelectDoctor[doctorid]'>$SelectDoctor[doctorname] ( $SelectDoctor[departmentname] )</option>";				
                                            }
                                }
                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" placeholder="Appointment Reason" class="form-control no-resize" name="appreason"
                                                id="appreason" s><?php echo $SelectApp['app_reason']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 ">
                                    <div class="form-group drop-custum">
                                        <select name="select" id="select" class=" form-control show-tick">

                                            <option value="">Select Status</option>
                                            <?php
                                                $arr = array("Active","Inactive");
                                                foreach($arr as $val)
                                                {
                                                    if($val == $SelectApp['status'])
                                                    {
                                                        echo "<option value='$val' selected>$val</option>";
                                                    }
                                                    else
                                                    {
                                                        echo "<option value='$val'>$val</option>";			  
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12">

                                    <input type="submit" class="btn btn-raised g-bg-cyan" name="submit" id="submit"
                                        value="Submit" />

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





    <?php include 'adfooter.php'; ?>
    <script type="application/javascript">
    function validateform() {
        if (document.frmappnt.select4.value == "") {
            alert("Patient name should not be empty..");
            document.frmappnt.select4.focus();
            return false;
        } else if (document.frmappnt.select5.value == "") {
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