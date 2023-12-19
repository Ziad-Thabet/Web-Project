<?php
include("adheader.php");

include("dbconnection.php");
?>







<!-- Patient -->
<?php
if($_SESSION['patientid'])
{
$sqlpatient = "SELECT * FROM patient WHERE patientid='$_SESSION[patientid]' ";
$querypatient = mysqli_query($con,$sqlpatient);
$SelectPatient = mysqli_fetch_array($querypatient);

$sqlDOC= "SELECT * FROM doctor WHERE doctorid = '$_POST[SebderName]'";
$querDOC = mysqli_query($con,$sqlDOC);
$SelectDcotor = mysqli_fetch_array($querDOC);
$nameee=$SelectDcotor['doctorid'];
?>
<?php
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO message(SenderID,SenderName,ReciverID,ReceiverName,msg) values('$_SESSION[patientid]','$SelectPatient[patientname]','$_POST[SebderName]','$nameee','$_POST[MSG]')";
        
        if($query = mysqli_query($con,$sql))
		{
            echo "<script>alert('Message record Sent successfully...');</script>";
			
		}
		else
		{
            echo mysqli_error($con);
		}


        
}
?>
<form action="" method="POST">
        <label>
            <select name="SebderName" class="selectpicker" id="department"
                >
                <option value="">Select Doctor</option>
                <?php
                $sqldept = "SELECT * FROM doctor WHERE status='Active'";
                $querydept = mysqli_query($con,$sqldept);
                while($SelectDepartment = mysqli_fetch_array($querydept))
                {
                    echo "<option value='$SelectDepartment[doctorid]'>$SelectDepartment[doctorname] (";
                    $sqldept = "SELECT * FROM department WHERE departmentid='$SelectDepartment[departmentid]'";
                    $querydepta = mysqli_query($con,$sqldept);
                    $SelectDepartment = mysqli_fetch_array($querydepta);
                    echo $SelectDepartment['departmentname'];
                    echo ")</option>";
                }
                ?>
            </select>
            <i class="ion-medkit"></i>
            <textarea class="form-control" name="MSG"
                placeholder="Message"></textarea>
        </label>
        <a href="SendMessage.php" class="btn" name="submit" id="submit">send</a>
        <a href="ViewMessage.php" class="btn">View Message</a>
</form>

<?php }?>
<!-- Patient -->





<!-- Doctor -->
<?php
if($_SESSION['doctorid'])
{
    $sqlDOC = "SELECT * FROM doctor WHERE doctorid='$_SESSION[doctorid]' ";
    $querDOC = mysqli_query($con,$sqlDOC);
    $SelectDcotor = mysqli_fetch_array($querDOC);
    $sqlpatient= "SELECT * FROM patient WHERE patientname = '$_POST[SebderName]'";
    $querpatient = mysqli_query($con,$sqlpatient);
    $SelectPatient = mysqli_fetch_array($querpatient);
    $IDDD=$SelectPatient['patientid'];
?>
<?php
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO message(SenderID,SenderName,ReciverID,ReceiverName,msg) values('$_SESSION[doctorid]','$SelectDcotor[doctorname]','$IDDD','$_POST[SebderName]','$_POST[MSG]')";
        
        if($query = mysqli_query($con,$sql))
		{
            echo "<script>alert('Message record Sent successfully...');</script>";
			
		}
		else
		{
            echo mysqli_error($con);
		}
}
?>
<form action="" method="POST">

    <label>
    <select name="SebderName" class="selectpicker" id="department"
        >
        <option value="">Select Patient</option>
        <?php
        $sqldept = "SELECT * FROM patient WHERE status='Active'";
        $querydept = mysqli_query($con,$sqldept);
        while($SelectPatient = mysqli_fetch_array($querydept))
        {
            echo "<option value='$SelectPatient[patientname]'> ";

            echo $SelectPatient['patientname'];

            echo "</option>";
        }
        ?>
    </select>
    <i class="ion-medkit"></i>
    <textarea class="form-control" name="MSG"
        placeholder="Message"></textarea>
    </label>
<button type="submit" class="btn" name="submit" id="submit">send</button>
</form>

<?php }?>
<!-- Doctor -->






<!-- Admin -->
<?php
if($_SESSION['adminid'])
{
    $sqladmin = "SELECT * FROM admin WHERE adminid='$_SESSION[adminid]' ";
    $queryadmin = mysqli_query($con,$sqladmin);
    $SelectAdmin = mysqli_fetch_array($queryadmin);
    if(isset($_POST['submit']))
    {
            $sqlDOC = "SELECT * FROM doctor WHERE doctorid = '$_POST[SebderName]'";
            $querDOC = mysqli_query($con,$sqlDOC);
            if($SelectDcotor = mysqli_fetch_array($querDOC)){
            $nameee= $SelectDcotor['doctorname'];
            $sql ="INSERT INTO message(SenderID,SenderName,ReciverID,ReceiverName,msg) values('$_SESSION[adminid]','$SelectAdmin[adminname]','$_POST[SebderName]','$nameee','$_POST[MSG]')";
            
            if($query = mysqli_query($con,$sql))
            {
                echo "<script>alert('Message record Sent successfully...');</script>";
                
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    
    
        $sqlpatient= "SELECT * FROM patient WHERE patientname = '$_POST[SebderName12]'";
        $querpatient = mysqli_query($con,$sqlpatient);
        if($SelectPatient = mysqli_fetch_array($querpatient)){
    
            $IDDD=$SelectPatient['patientid'];
            $sql ="INSERT INTO message(SenderID,SenderName,ReciverID,ReceiverName,msg) values('$_SESSION[adminid]','$SelectAdmin[adminname]','$IDDD','$_POST[SebderName12]','$_POST[MSG]')";
            
            if($query = mysqli_query($con,$sql))
            {
                echo "<script>alert('Message record Sent successfully...');</script>";
                
            }
            else
            {
                echo mysqli_error($con);
            }
        }
    }
?>
    <form action="" method="POST">

    <label>
        <select name="SebderName" class="selectpicker" id="department"
            >
            <option value="">Select Doctor</option>
            <?php
            $sqldept = "SELECT * FROM doctor WHERE status='Active'";
            $querydept = mysqli_query($con,$sqldept);
            while($SelectDepartment = mysqli_fetch_array($querydept))
            {
                echo "<option value='$SelectDepartment[doctorid]'>$SelectDepartment[doctorname] (";
                $sqldept = "SELECT * FROM department WHERE departmentid='$SelectDepartment[departmentid]'";
                $querydepta = mysqli_query($con,$sqldept);
                $SelectDepartment = mysqli_fetch_array($querydepta);
                echo $SelectDepartment['departmentname'];

                echo ")</option>";
            }
            ?>
        </select>
        <i class="ion-medkit"></i>
        <textarea class="form-control" name="MSG"
            placeholder="Message"></textarea>
    </label>
    <label>
        <select name="SebderName12" class="selectpicker" id="department"
            >
            <option value="">Select Patient</option>
            <?php
            $sqldept = "SELECT * FROM patient WHERE status='Active'";
            $querydept = mysqli_query($con,$sqldept);
            while($SelectPatient = mysqli_fetch_array($querydept))
            {
                echo "<option value='$SelectPatient[patientname]'> ";

                echo $SelectPatient['patientname'];

                echo "</option>";
            }
            ?>
        </select>
    </label>
    <button type="submit" class="btn" name="submit" id="submit">send</button>
    </form>
<?php }?>



<?php
include("adfooter.php");
?>