<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$date = date("Y-m-d");
$time = date("H:i:s");
?>
<!DOCTYPE html>
<html>





<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Trex's Hospital</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- JQuery DataTable Css -->
    <link href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>





<body class="theme-cyan">
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>

    <div class="overlay"></div>
    <nav class="navbar clearHeader">
        <div class="col-12">
            <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand" href="logout.php">Trex's Hospital</a> </div>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a data-placement="bottom" title="Full Screen" href="logout.php"><i class="zmdi zmdi-sign-in"></i></a>
                </li>

            </ul>
        </div>
    </nav>
    <section>
        <aside id="leftsidebar" class="sidebar">
            <?php
            if (isset($_SESSION['adminid'])) {
            ?>
                <!--Admin Menu -->
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open"><a href="adminaccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                            <ul class="ml-menu">
                                <li><a href="adminprofile.php">Admin Profile</a></li>
                                <li><a href="admin.php">Add Admin</a></li>
                                <li><a href="viewadmin.php">View Admin</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Appointment</span> </a>
                            <ul class="ml-menu">
                                <li><a href="appointment.php">New Appointment</a></li>
                                <li><a href="viewappointmentpending.php">View Pending Appointments</a>
                                </li>
                                <li><a href="viewappointmentapproved.php">View Approved Appointments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Doctors</span> </a>
                            <ul class="ml-menu">
                                <li><a href="doctor.php">Add Doctor</a></li>
                                <li><a href="viewdoctor.php">View Doctor</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                            <ul class="ml-menu">
                                <li><a href="patient.php">Add Patient</a></li>
                                <li><a href="viewpatient.php">View Patient Report</a></li>

                            </ul>
                        </li>


                        <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                            <ul class="ml-menu">
                                <li><a href="department.php">Add Department</a></li>
                                <li><a href="viewdepartment.php">View Department</a></li>
                                <li><a href="treatment.php">Add Treatment type</a></li>
                                <li><a href="viewtreatment.php">View Treatment types</a></li>
                                <li><a href="SendMessage.php">Send Message</a></li>
                                <li><a href="ViewMessage.php">View Message</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- Admin Menu -->
            <?php } ?>


            <!-- doctor Menu -->
            <?php
            if (isset($_SESSION['doctorid'])) {
            ?>
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open"><a href="doctoraccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                            <ul class="ml-menu">
                                <li><a href="doctorprofile.php">Profile</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Appointment</span> </a>
                            <ul class="ml-menu">
                                <li><a href="viewappointmentpending.php" style="width:250px;">View Pending Appointments</a>
                                </li>
                                <li><a href="viewappointmentapproved.php" style="width:250px;">View Approved
                                        Appointments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Doctors</span> </a>
                            <ul class="ml-menu">

                                <li><a href="doctortimings.php">Add Visiting Hour</a></li>
                                <li><a href="viewdoctortimings.php">View Visiting Hour</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                            <ul class="ml-menu">
                                <li><a href="viewpatient.php">View Patient Report</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                            <ul class="ml-menu">
                                <li><a href="viewtreatment.php" class=" waves-effect waves-block">View Treatment types</a></li>
                                <li><a href="SendMessage.php">Send Message</a></li>
                                <li><a href="ViewMessage.php">View Message</a></li>

                            </ul>
                        </li>

                    </ul>
                </div>

            <?php }; ?>
            <!-- doctor Menu -->




            <!-- patient Menu -->
            <?php
            if (isset($_SESSION['patientid'])) {
            ?>
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open"><a href="patientaccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                            <ul class="ml-menu">
                                <li><a href="patientprofile.php">View Profile</a></li>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Appointment</span> </a>
                            <ul class="ml-menu">
                                <?php echo "<li><a href='appointmentpppp.php?patientid=$_SESSION[patientid]' >Add Appointment</a></li>";
                                echo "<li><a href='viewappointment.php'?patientid=$_SESSION[patientid]'>View Appointments</a></li>"; ?>
                            </ul>
                        </li>

                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Treatment</span> </a>
                            <ul class="ml-menu">
                                <li><a href="viewtreatmentrecord.php">View Treatment Report</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>FeedBack</span> </a>
                            <ul class="ml-menu">

                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                            <ul class="ml-menu">
                                <!-- <li><a href="treatment.php" class=" waves-effect waves-block">Add Treatment type</a></li>
                            <li><a href="viewtreatment.php" class=" waves-effect waves-block">View Treatment types</a></li> -->
                                <li><a href="viewtreatmentrecord.php">View Treatment Report</a></li>
                                <li><a href="viewtreatment.php">View Treatment</a></li>
                                <li><a href="SendMessage.php">Send Message</a></li>
                                <li><a href="ViewMessage.php">View Message</a></li>
                            </ul>
                        </li>
                    </ul>
                    </li>


                    </ul>
                </div>

            <?php }; ?>
            <!-- patient Menu -->






            <!-- QualityManger Menu -->
            <?php
            if (isset($_SESSION['QualityID'])) {
            ?>
                <div class="menu">
                    <ul class="list">
                        <li class="header">MAIN NAVIGATION</li>
                        <li class="active open"><a href="qualityaccount.php"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                            <ul class="ml-menu">
                                <li><a href="qualityprofile.php">Profile</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                            <ul class="ml-menu">
                                <li><a href="viewpatient.php">View Patient Report</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                            <ul class="ml-menu">
                                <!-- <li><a href="treatment.php" class=" waves-effect waves-block">Add Treatment type</a></li>
                            <li><a href="viewtreatment.php" class=" waves-effect waves-block">View Treatment types</a></li> -->
                                <li><a href="viewtreatmentrecord.php">View Treatment Report</a></li>
                                <li><a href="viewtreatment.php">View Treatment</a></li>
                                <li><a href="ViewMessage.php">View Messages</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            <?php }; ?>
            <!-- QualityManger Menu -->


        </aside>

    </section>
    <section class="content home">