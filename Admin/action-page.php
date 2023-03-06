<?php

session_start();
if(isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
   header("Location: login.php");
}

 require 'connection/connection_db.php';
$std_matric_number = urldecode(base64_decode(filter_input(INPUT_GET,'data')));
$decrypt_session_id = urldecode(base64_decode(filter_input(INPUT_GET, 'sid')));
$prog = urldecode(base64_decode(filter_input(INPUT_GET, 'prog')));

// Select the data from the database
$std_query = "SELECT * FROM student_tbl WHERE matricnumber = :matric";
$std_stmt = $connect->prepare($std_query);
$std_stmt->bindValue(':matric', $std_matric_number);
$std_stmt->execute();
$std_result = $std_stmt->fetch(PDO::FETCH_ASSOC);


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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--style-->
    <?php include('includes/head.php'); ?>
    <link rel="stylesheet" href="css/verify.css">
    <link rel="stylesheet" href="css/modal.css">
    <!--for the title it will collect the login name-->
    <!--style-->

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-dark navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="color:white" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Logout -->
                <ul class="nav navbar-nav navbar-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline text-white"><?php echo $display_username; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right"
                            style="left: inherit; right: 0px;border-radius:0.5em;">
                            <!-- User image -->
                            <li class="user-header bg-white">
                                <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>"
                                    class="img-circle elevation-2" alt="User Image">
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
                            <img src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>"
                                class="profile-user-img img-fluid img-circle" alt="User-Image">
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

                            <li class="nav-item menu-open">
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
                                        <a href="student-list.php" class="nav-link  active bg-light">
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

                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="fa-solid fa-gear"></i>
                                    <p>
                                        Settings
                                    </p>
                                    <i class="right fas fa-angle-left"></i>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="session.php" class="nav-link">
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
                                <li class="breadcrumb-item active">Student-Data</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- /Section-->
            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Student Data</h3>

                                    <p>
                                        <?php if($successstatusMsg){
                                          
                                            ?>
                                        <hr class="mt-5" />

                                    <div class="alert alert-success left-icon-alert mt-4" role="alert">
                                        <strong>Well done! </strong><?php echo htmlentities($successstatusMsg); ?>
                                    </div><?php } 
                                            else if($errorstatusMsg){
                                          
                                                ?>
                                    <hr class="mt-5" />
                                    <div class="alert alert-danger left-icon-alert mt-4" role="alert">
                                        <strong>Oppss!</strong> <?php echo htmlentities($errorstatusMsg); ?>
                                    </div>
                                    <?php } ?>
                                    </p>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <!-- form start //MSK-00097-->
                                    <div class="form-group">
                                        <form action="action-page-db.php" method="POST" enctype="multipart/form-data">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <input type="hidden" name="session_id"
                                                            value="<?php echo $decrypt_session_id; ?> || <?php echo $action_session_id; ?>">
                                                        <input type="hidden" name="matric_number"
                                                            value="<?php echo $std_matric_number ;?>">
                                                        <input type="hidden" name="program"
                                                            value="<?php echo $prog;?> || <?php echo $new_program; ?>">
                                                        <label for="">FirstName</label>
                                                        <input type='text' name='fname' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['fname']);?>'>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">MiddleName(Othername)</label>
                                                        <input type='text' name='mname' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['mname']);?>'>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">LastName(Surname)</label>

                                                        <input type='text' name='lname' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['lname']);?>'>
                                                    </div>
                                                </div><!-- /row -->
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label for="">Department</label>
                                                        <input type='text' name='dept' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['dept']);?>'>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Grade</label>
                                                        <?php $grd_options = $std_result['grade'];?>
                                                        <select name="grade" id="" class="form-control">
                                                            <option value="">Please choose an option</option>
                                                            <optgroup label="MASTER'S DEGREE">
                                                                <option value="MASTER'S"
                                                                    <?php if($grd_options=="MASTER'S") echo 'selected="selected"'; ?>>
                                                                    MASTER'S</option>
                                                            </optgroup>
                                                            <optgroup label="BACHELOR'S DEGREE">
                                                                <option value="FIRST CLASS"
                                                                    <?php if($grd_options=="FIRST CLASS") echo 'selected="selected"'; ?>>
                                                                    FIRST CLASS </option>
                                                                <option value="SECOND CLASS(UPPER DIVISION)"
                                                                    <?php if($grd_options=="SECOND CLASS(UPPER DIVISION)") echo 'selected="selected"'; ?>>
                                                                    SECOND CLASS(UPPER DIVISION) </option>
                                                                <option value="SECOND CLASS(LOWER DIVISION)"
                                                                    <?php if($grd_options=="SECOND CLASS(LOWER DIVISION)") echo 'selected="selected"'; ?>>
                                                                    SECOND CLASS(LOWER DIVISION)</option>
                                                                <option value="THIRD CLASS"
                                                                    <?php if($grd_options=="THIRD CLASS") echo 'selected="selected"'; ?>>
                                                                    THIRD CLASS</option>
                                                                <option value="PASS"
                                                                    <?php if($grd_options=="PASS") echo 'selected="selected"'; ?>>
                                                                    PASS</option>
                                                            </optgroup>

                                                        </select>
                                                    </div>
                                                </div><!-- /row -->
                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <label for="">Program</label>
                                                        <?php $prog_options = $std_result['program'];?>
                                                        <select name="program" id="" class="form-control">
                                                            <option value="">Please choose an option</option>
                                                            <option value="MASTER"
                                                                <?php if($prog_options=="MASTER") echo 'selected="selected"'; ?>>
                                                                MASTER'S DEGREE </option>
                                                            <option value="BACHELOR"
                                                                <?php if($prog_options=="BACHELOR") echo 'selected="selected"'; ?>>
                                                                BACHELOR'S DEGREE </option>
                                                        </select>

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="">Gender</label>
                                                        <?php $g_options = $std_result['gender'];?>
                                                        <select name="gender" id="" class="form-control">
                                                            <option value="">Please choose an option</option>
                                                            <option value="Male"
                                                                <?php if($g_options=="Male") echo 'selected="selected"'; ?>>
                                                                Male</option>
                                                            <option value="Female"
                                                                <?php if($g_options=="Female") echo 'selected="selected"'; ?>>
                                                                Female</option>
                                                        </select>
                                                    </div>
                                                </div><!-- /row -->

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="">Matric Number</label>
                                                        <input type='text' name='matricnumber' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['matricnumber']);?>'>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Ref Number</label>
                                                        <input type='text' name='refnumber' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['refnumber']);?>'>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="">Current Status</label>
                                                        <?php $s_options = $std_result['status'];?>
                                                        <select name="status" id="" class="form-control">
                                                            <option value="">Please choose an option</option>
                                                            <option value="GRADUATE"
                                                                <?php if($s_options=="GRADUATE") echo 'selected="selected"'; ?>>
                                                                GRADUATE</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="">Year Of Graduation</label>
                                                        <input type='text' name='year' class='form-control'
                                                            value='<?php echo htmlspecialchars($std_result['year']);?>'>
                                                    </div>

                                                </div>

                                                <hr>
                                                <div class="row mt-3">
                                                    <div class="col-4 col-sm-4">
                                                        <a href="list.php?r_sid=<?= urlencode(base64_encode($decrypt_session_id))?> || <?= urlencode(base64_encode($action_session_id))?>
                                                    &prog=<?= urlencode(base64_encode($prog))?> || <?= urlencode(base64_encode($new_program))?>"
                                                            class="btn form-control bg-dark">Back</a>
                                                    </div>
                                                    <div class="col-4 col-sm-4">
                                                        <a href="#myModal" data-toggle="modal">
                                                            <button class="btn form-control bg-danger"
                                                                <?php if(($std_result['matricnumber']=="")) echo 'disabled="disabled"';?>>
                                                                Delete
                                                            </button>
                                                        </a>
                                                    </div>
                                                    <div class="col-4 col-sm-4">
                                                        <input type="submit" value="Update" name="update"
                                                            <?php if(($std_result['matricnumber']=="")) echo 'disabled="disabled"';?>
                                                            class="btn form-control bg-green">
                                                    </div>
                                                </div>
                                            </div><!-- /container-fluid-->
                                        </form>
                                    </div><!-- /form-group -->

                                </div>
                            </div>
                            <!-- /.card-body -->

                            <!-- /.card -->
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
            </section>
            <!-- /Section-->
            <!-- Modal HTML -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                <i class="material-icons"><i class="fa-solid fa-xmark"></i></i>
                            </div>
                            <h4 class="modal-title w-100">Are you sure?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <form action="action-page-db.php" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">

                                <p>Do you really want to delete these records? This process cannot be undone.</p>
                                <input type="hidden" name="delete-matric-number"
                                    value="<?php echo $std_matric_number ;?>">
                                <input type="hidden" name="del_session_id"
                                    value="<?php echo $action_session_id .$decrypt_session_id; ?>">
                                <input type="hidden" name="del_prog" value="<?php echo $prog.$new_program; ?>">
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>


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