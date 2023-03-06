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
 $display_email = $user_info_row['email'];
 $display_gender = $user_info_row['gender'];
 $display_contact = $user_info_row['contact'];
 $display_address = $user_info_row['address'];

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
                                <a href="profile.php" class="btn float-right text-white">Profile</a>
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
                                <a href="profile.php" class="nav-link active bg-light">
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
                            <h2 class="m-0">
                            </h2>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="student-verification.php"
                                        class="breadcrumb-link">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">

                <div class="row">
                    <div class="col-sm-4">

                        <!-- Profile Image -->
                        <div class="box box-primary">
                            <div class="box-body box-profile box-body-white">
                                <img class="profile-user-img img-responsive img-circle mt-4 mx-auto d-block"
                                    src="data:image/*;charset=utf8;base64,<?php echo base64_encode($display_picture); ?>"
                                     alt="profile picture">

                                <h3 class="profile-username text-center"><?php echo  $display_fullname; ?></h3>

                                <p class="text-muted text-center"><?php echo $display_role; ?></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b class="ml-2">Email:</b><a
                                            class="float-right mr-2"><?php echo $display_email; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b class="ml-2">Contact:</b><a
                                            class="float-right mr-2"><?php echo $display_contact; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b class="ml-2">Gender:</b><a
                                            class="float-right mr-2"><?php echo $display_gender; ?></a>
                                    </li>
                                </ul>
                                

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>
                    <!-- /.col-sm4 -->
                  
                    <div class="col-sm-8">
                        <div class="card card-orange card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs nav-justified" id="custom-tabs-four-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                            href="#custom-tabs-four-home" role="tab"
                                            aria-controls="custom-tabs-four-home" aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-four-profile" role="tab"
                                            aria-controls="custom-tabs-four-profile"
                                            aria-selected="false">Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                            href="#custom-tabs-four-messages" role="tab"
                                            aria-controls="custom-tabs-four-messages" aria-selected="false">Change
                                            Password</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                            href="#custom-tabs-four-settings" role="tab"
                                            aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-four-tabContent">
                                    <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-home-tab">

                                        <p>
                                            <?php if($messagesuccess){?>
                                        <div class="alert alert-success left-icon-alert mt-4" role="alert">
                                            <strong>Well done! </strong><?php echo htmlentities($messagesuccess); ?>
                                        </div><?php }
                                         
                                                else if($messageerror){?>
                                        <div class="alert alert-danger left-icon-alert mt-4" role="alert">
                                            <strong>Oppss!</strong> <?php echo htmlentities($messageerror); ?>
                                        </div>
                                        <?php } ?>
                                        </p>

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-profile-tab">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <th class="table">Full Name:</th>
                                                <td><?php echo $display_fullname; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">User Name:</th>
                                                <td><?php echo $display_username; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">Gender:</th>
                                                <td><?php echo $display_gender; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">Email:</th>
                                                <td><?php echo $display_email; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">Contact:</th>
                                                <td><?php echo $display_contact; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">Address:</th>
                                                <td><?php echo $display_address; ?></td>
                                            </tr>
                                            <tr>
                                                <th class="table">Role:</th>
                                                <td><?php echo $display_role; ?></td>
                                            </tr>

                                        </table>

                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-messages-tab">

                                        <!-- The timeline -->
                                        <div class="well">

                                            <form action="profile-db.php" class="form-horizontal" id="change_password"
                                                name="" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="" value="">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Old
                                                                Password</label>
                                                            <input type="hidden" name="user_id"
                                                                value="<?php echo $user_id ?>">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control mt-3"
                                                                name="old_password" id="old_password">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">New
                                                                Password</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control mt-3"
                                                                name="new_password" id="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Confirm
                                                                Password</label>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="password" class="form-control mt-3"
                                                                name="confirm_password" id="confirm_password">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <div class="col-sm-4">

                                                    </div>
                                                    <div class=" col-sm-8 ">

                                                        <button type="submit" name="change_password" class="btn mb-3"
                                                            id="changepassword">Change Password</button>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-four-settings-tab">
                                        <div class="well">
                                            <form action="profile-db.php" enctype="multipart/form-data"
                                                class="form-horizontal" name="update_profile" id="update_profile"
                                                method="POST">
                                                <input type="hidden" name="user_update_id"
                                                    value="<?php echo $user_id ?>">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">First
                                                                Name</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="Text" class="form-control mt-3" name="fname"
                                                                id="" value="<?php echo $display_firstname; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Last
                                                                Name</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="Text" class="form-control mt-3" name="lname"
                                                                id="" value="<?php echo $display_lastname; ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for=""
                                                                class="control-label ml-2 mt-3">UserName</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="Text" class="form-control mt-3" name="username"
                                                                id="" value="<?php echo $display_username; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Email</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="email" class="form-control mt-3" name="email"
                                                                id="" value="<?php echo $display_email; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for=""
                                                                class="control-label ml-2 mt-3">Contact</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="tel" class="form-control mt-3" name="contact"
                                                                id="" value="<?php echo $display_contact; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for=""
                                                                class="control-label ml-2 mt-3">Address</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="Text" class="form-control mt-3" name="address"
                                                                id="" value="<?php echo $display_address; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Role</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <input type="Text" class="form-control mt-3" name="role"
                                                                id="" value="<?php echo $display_role; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">Gender</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <select name="gender" id="" class="form-control mt-3">

                                                                <option value="">Please choose an option</option>
                                                                <option value="Male"
                                                                    <?php if($display_gender == "Male") echo 'selected="selected"'; ?>>
                                                                    Male</option>
                                                                <option value="Female"
                                                                    <?php if($display_gender =="Female") echo 'selected="selected"'; ?>>
                                                                    Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <label for="" class="control-label ml-2 mt-3">change picture</label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                        <input type="file" name="image" id="file-input" class="mt-3" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <div class="form-group">
                                                    <div class="col-sm-4"> </div>
                                                    <div class=" col-sm-8 ">

                                                        <button type="submit" name="update" class="btn mb-3"
                                                            id="update">Update</button>
                                                    </div>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div><!-- /.col-sm-7 -->

                </div><!-- /.row -->
            </section><!-- /.section content -->

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