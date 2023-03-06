<?php
    session_start();
    if(isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
    } else {
        header("Location: login.php");
    }
     require 'connection/connection_db.php';


    $id = filter_input(INPUT_POST, 'display_session');
    $degree_type = filter_input(INPUT_POST, 'degree_type');
    $r_sid = (urldecode(base64_decode(filter_input(INPUT_GET,'r_sid'))));
    $pr_sid = (urldecode(base64_decode(filter_input(INPUT_GET, 'pr_sid'))));
    $pr_prog = (urldecode(base64_decode(filter_input(INPUT_GET, 'pr_prog'))));
    $mr_prog = (urldecode(base64_decode(filter_input(INPUT_GET, 'prog'))));
 
    //Session information
    $session_query = "SELECT * FROM Session_Tbl WHERE id = :id || id = :pr_sid || id = :r_sid";
    $session_statement=$connect->prepare($session_query);
    $session_statement->bindValue(':id', $id);
    $session_statement->bindValue(':pr_sid', $pr_sid);
    $session_statement->bindValue(':r_sid', $r_sid);
    $session_statement->execute();
    $session_row = $session_statement->fetch(PDO::FETCH_ASSOC);
    $session_statement->closeCursor();
    $session = $session_row['SessionName'];

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
                                        <a href="student-list.php" class="nav-link active bg-light ">
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
                                <li class="breadcrumb-item"><a href="student-list.php"
                                        class="breadcrumb-link">Student-list</a></li>
                                <li class="breadcrumb-item active">Table-list</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">ALL VERIFIED <?php echo $pr_prog.$mr_prog.$degree_type.'\'S' ;?> STUDENT</h3>
                                    <span class="float-right d-md-inline text-orange">Session: <?php echo ($session);?></span>
                                   
                                </div>
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-8 mt-3">
                                            
                                            <a href="print-list.php?data=<?= (urlencode(base64_encode($id)))?> 
                                            || <?= urlencode(base64_encode($pr_sid)) ?> 
                                            || <?= urlencode(base64_encode($r_sid))?>
                                            &prog=<?= (urlencode(base64_encode($degree_type)))?> 
                                            || <?= urlencode(base64_encode($pr_prog))?> 
                                            || <?= urlencode(base64_encode($mr_prog))?> ">
                                            <button class="btn btn-secondary w-25" tabindex="0" aria-controls="example1"
                                                type="button"><span> Print</span>
                                            </button>
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <div id="example1_filter" class="dataTables_filter float-right">
                                                <label>Search:
                                                    <input type="search" class="form-control form-control-sm"
                                                        placeholder="" id="search" name="search" aria-controls="example1">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                 
                                    <table id = "myTable"class="table table-bordered  print">
                                        <thead>
                                            <tr>
                                                <th style="width: 5em;">#</th>
                                                <th style="width:10em">Matric Number</th>
                                                <th style="width:10em">Ref Number</th>
                                                <th>Name</th>
                                                <th style="width:12em">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                
                                                    // Select the data from the database
                                                    $sn = 1;
                                                    $query = "SELECT * FROM student_tbl WHERE (session_id = '$id' || session_id = '$pr_sid' || session_id = '$r_sid') AND (program = '$degree_type' || program = '$pr_prog' || program = '$mr_prog')";
                                                    $stmt = $connect->prepare($query);
                                                    $stmt->execute();
                                                    $users = $stmt->fetchAll();
                                                    foreach($users as $row)
                                                    {
                                                ?>
                                            <tr>
                                                <td><?php echo $sn ?></td>          
                                                <td><?php echo $matric = $row['matricnumber']; ?></td>
                                                <td><?php echo $row['refnumber']; ?></td>
                                                <td><?php echo  $row['fname'].' '.$row['lname'].' ' .$row['mname']; ?></td>
                                                <td>
                                                    <a href='action-page.php?data=<?= urlencode(base64_encode($matric)) ?>
                                                    &sid=<?= urlencode(base64_encode($id))?> || <?= urlencode(base64_encode($r_sid))?> || <?= urlencode(base64_encode($pr_sid))?>
                                                    &prog=<?= urlencode(base64_encode($degree_type))?> || <?= urlencode(base64_encode($mr_prog)) ?>|| <?= urlencode(base64_encode($pr_prog)) ?>'
                                                    style='display:inline-block;background-color:grey;color:white'
                                                    class='btn w-100'><small><i
                                                    class='fa-solid fa-pen-to-square'></i></small>View</a>
                                                </td>
                                            </tr>
                                            <?php $sn++; } ?>
                                        </tbody>
                                    </table>
                                    
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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

  <script>
    $(document).ready(function(){
        $('#search').keyup(function(){
            search_table($(this).val());
        });
        function search_table(value){
            $('#myTable tr').each(function(){
            var found = 'false';
            $(this).each(function(){
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0)
                {
                    found ='true';
                }
            });
            if(found=='true'){
                $(this).show();
            }else{
                $(this).hide();
            }
        });
        }
    });
  </script>
    <!--/Script-->
</body>

</html>