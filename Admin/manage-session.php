<?php
session_start();
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
   header("Location: login.php");
}
require 'connection/connection_db.php';

  // Select all User Information
  $user_info_query = "SELECT * FROM User_tbl WHERE id = :id";
  $user_info_statement=$connect->prepare($user_info_query);
  $user_info_statement->bindValue(':id', $user_id);
  $user_info_statement->execute();
  $user_info_row = $user_info_statement->fetch(PDO::FETCH_ASSOC);
  $user_info_statement->closeCursor();
  // user information
  $display_username = $user_info_row['username'];
  $display_picture = $user_info_row['image'];
  $display_firstname = $user_info_row['fname'];
  $display_lastname = $user_info_row['lname'];
  $display_fullname = $display_firstname . ' ' . $display_lastname;
  $display_role = $user_info_row['role'];

   // Select all School Information
$school_info_query = "SELECT * FROM School_tbl WHERE id = 1";
$school_info_statement=$connect->prepare($school_info_query);
$school_info_statement->execute();
$school_info_row = $school_info_statement->fetch(PDO::FETCH_ASSOC);
$school_info_statement->closeCursor();
   // School information
   $display_school_name = $school_info_row['schoolname'];
   $display_login_picture = $school_info_row['loginimage'];
   $display_verify_picture = $school_info_row['verifyimage'];
   

$id = filter_input(INPUT_POST, 'display_session');

// Select the data from the database
$query = "SELECT * FROM Session_Tbl WHERE id = :id";
$stmt = $connect->prepare($query);
$stmt->bindValue(':id', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!--style-->
    <?php include('includes/head.php'); ?>
    <link rel="stylesheet" href="css/verify.css">
    <!--style-->
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color:white" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Logout -->
                <ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline text-white"><?php echo $display_username; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                            style="left: inherit; right: 0px;border-radius:0.5em;">
                            <!-- User image -->
                            <li class="user-header bg-white">
                                <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>" class="img-circle elevation-2" alt="User Image">
                                <p>
                                    <?php echo $display_fullname; ?>
                                    <small><?php echo $display_role; ?></small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="Profile.php" class="btn float-right text-white">Profile</a>
                                <a href="log-out.php" class="btn  text-white">Sign out</a>
                            </li>
                        </ul>
                    </li>
                </ul>

            </ul>
        </nav>
        <!-- /.navbar -->

        <div class="content-wrapper">
            <!--SideBar-->
            <aside class="main-sidebar sidebar-dark-primary bg-dark elevation-10">
                <!-- Brand Logo -->
                <a class="brand-link">
                    <img src='data:image/*;charset=utf8;base64,<?php echo ($display_login_picture); ?>'
                        class='logo' alt='school logo'>
                    <span class="d-none d-md-inline text-white">Administrative Site</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-2 pb-1 d-flex">
                        <div class="image">
                            <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>" class="profile-user-img img-fluid img-circle" alt="User-Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block"><?php echo  $display_fullname; ?></a>
                            <a href="#" class="d-block"> <b class="online"> &#x2022;</b> Online</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a href="student-verification.php" class="nav-link">
                                    <i class="fa-solid fa-gauge"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa-solid fa-user"></i>
                                    <p>
                                        Student
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="add-student.php" class="nav-link">
                                            <i class="fa-solid fa-user-plus"></i>
                                            <p>
                                                Add Student
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="student-list.php" class="nav-link">
                                            <i class="fa-solid fa-list"></i>
                                            <p>Student list</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="profile.php" class="nav-link">
                                    <i class="fa-regular fa-id-card"></i>
                                    <p>
                                        Profile
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item menu-open">
                                <a class="nav-link ">
                                    <i class="fa-solid fa-gear"></i>
                                    <p>
                                        Settings
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview ">
                                    <li class="nav-item">
                                        <a href="session.php" class="nav-link  active bg-light">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            <p>Session</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="User.php" class="nav-link">
                                        <i class="fa-solid fa-user-plus"></i>                                            
                                        <p>User</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="school.php" class="nav-link">
                                        <i class="fa-solid fa-school-flag"></i>                                          
                                        <p>School</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <!--/SideBar-->

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h3 class="m-0">
                            </h3>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="student-verification.php"
                                        class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active">Session</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Session</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- form start //MSK-00097-->
                                    <div class="form-group">
                                        <form action="session_db.php" method="post">
                                            <div class="form-group has-success">
                                               
                                                <label for="success" class="control-label">Change Session</label>
                                                    <?php
                                                    echo "<input type='text'  name='update_session_name' class='form-control'
                                                    required='required' id='session_name' value='" . htmlspecialchars($result['SessionName']) . "'>";
                                                    ?>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">Change Start Date</label>
                                                    <?php
                                                    echo "<input type='date'  name='update_start_date' class='form-control'
                                                    required='required' id='start_date' value='" . $result['StartDate'] . "'>";
                                                    ?>
                                            </div>

                                            <div class="form-group has-success">
                                                <label for="success" class="control-label">Change End Date</label>
                                                    <?php
                                                    echo "<input type='date'  name='update_end_date' class='form-control'
                                                    required='required' id='end_date' value='" . $result['EndDate'] . "'>";
                                                    ?>
                                            </div>

                                            <div class="">
                                            <?php
                                                    echo "<input type='hidden'  name='s_id' id='s_id' value='" . $result['id'] . "'>";
                                                    ?>
                                                <input type="submit" name = "" value="Update" class="btn float-right">
                                            </div>
                                        </form>
                                    </div><!-- /form-group -->

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <!-- /.card -->
                        </div>
                        <div class="col-sm-3"></div>
                    </div>
                </div>
            </section>



        </div>
        <footer class="main-footer">
            <strong>© <a class="footer-link"><?php echo $display_school_name; ?></a> | All rights
                reserved 2023 | Design & Developed By <a href="#" class="footer-link">HR_Rashid Tech.</a></strong>
        </footer>
    </div>

    <!--Script-->
    <?php 
    include('includes/script.php');
    include("includes/Webscript.php");
  ?>
    <!--/Script-->
</body>

</html>