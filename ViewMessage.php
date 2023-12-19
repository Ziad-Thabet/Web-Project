<?php
session_start();
include("dbconnection.php");
include("adheader.php");
?>


<!-- Patient -->
<?php
if($_SESSION['patientid'])
{
    $sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
    $querypatient = mysqli_query($con,$sqlpatient);
    $SelectPatient = mysqli_fetch_array($querypatient);


    ?>
    <?php
    $sqlmsg = "SELECT *  FROM message WHERE ReciverID='$_SESSION[patientid]'AND ReceiverName='$SelectPatient[patientname]'";
    $querymsg = mysqli_query($con,$sqlmsg);

    while($Selectmsg = mysqli_fetch_array($querymsg))
    {

        echo "From: " . $Selectmsg["SenderName"]. " - Message: " . $Selectmsg["msg"]. "<br>";
    }
    ?>
<?php }?>



<!-- Doctor -->
<?php
if($_SESSION['doctorid'])
{
    $sqldoctor = "SELECT * FROM doctor WHERE doctorid='$_SESSION[doctorid]' ";
    $querydoctor = mysqli_query($con,$sqldoctor);
    $SelectDoctor = mysqli_fetch_array($querydoctor);


    ?>
    <?php
    $sqlmsg = "SELECT *  FROM message WHERE ReciverID='$_SESSION[doctorid]'AND ReceiverName='$SelectDoctor[doctorname]'";
    $querymsg = mysqli_query($con,$sqlmsg);

    while($Selectmsg = mysqli_fetch_array($querymsg))
    {

        echo "From: " . $Selectmsg["SenderName"]. " - Message: " . $Selectmsg["msg"]. "<br>";
    }
    ?>
<?php }?>







<!-- Admin -->
<?php
if($_SESSION['adminid'])
{
    $sqldoctor = "SELECT * FROM admin WHERE adminid='$_SESSION[adminid]' ";
    $queryadmin = mysqli_query($con,$sqladmin);
    $SelectAdmin = mysqli_fetch_array($queryadmin);
    ?>
    <?php
    $sqlmsg = "SELECT *  FROM message WHERE ReciverID='$_SESSION[adminid]'AND ReceiverName='$SelectAdmin[adminname]'";
    $querymsg = mysqli_query($con,$sqlmsg);
    while($Selectmsg = mysqli_fetch_array($querymsg))
    {
        echo "From: " . $Selectmsg["SenderName"]. " - Message: " . $Selectmsg["msg"]. "<br>";
    }
    ?>
<?php }?>









<!-- QualityManger -->
<?php

if($_SESSION['QualityID'])
{?>
    <section class="container">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <thead>
                    <tr>
                        <td>QualityManger</td>
                        <td>From</td>
                        <td>TO</td>
                        <td>Message</td>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sqlmanger = "SELECT * FROM qualitymanger WHERE QualityID='$_SESSION[QualityID]' ";
                        $querymanger = mysqli_query($con,$sqlmanger);
                        ;
                    
                        while($SelectQualityManger = mysqli_fetch_array($querymanger))
                        {

                            $sqlmsg = "SELECT *  FROM message";
                            $querymsg = mysqli_query($con,$sqlmsg);
                            $Select = mysqli_fetch_array($querymsg);
                            echo "<tr>
                            <td>&nbsp;$SelectQualityManger[QualityName]</td>
                            <td>&nbsp;$Select[SenderName]</td>
                            <td>&nbsp;$Select[ReceiverName]</td>
                            <td>&nbsp;$Select[msg]</td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
    </section>
    <?php }?>

<?php
include("adfooter.php");
?>
