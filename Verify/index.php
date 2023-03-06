<?php
  session_start();
 
include '../Admin/connection/connection_db.php';
   
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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $display_school_name .' '; ?>Certificate Verification Center</title>
    <link rel="icon" href="data:image/;charset=utf8;base64,<?php echo ($display_login_picture); ?>" type="">
    <link rel="stylesheet" type="text/css" href="../Admin/fontawesome/css/all.css">
    <link rel="stylesheet" href="../Admin/bootstrap5/css/bootstrap.min.css">
    <script src="../Admin/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script src="../Admin/bootstrap5/jquery/jquery.min.js"></script>
    <link rel="stylesheet" href="css/style1.css" type="text/css" media="all">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <img src="data:image/*;charset=utf8;base64,<?php echo ($display_verify_picture); ?>" class=" mx-auto d-block w-25" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="header text-center">
                    <b>
                        <h1><?php echo $display_school_name; ?></h1>
                    </b>
                </div>
            </div>

        </div>
        <div class="row">
            <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators text-dark">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="img/img1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <b>
                                <h5 class="text-dark"><?php echo $display_school_name?></h5>
                            </b>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="img/img1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <b>
                                <h5 class="text-dark"><?php echo $display_school_name?></h5>
                            </b>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="header text-center">
                    <b>
                        <h4 class="text-danger"><?php echo $display_school_name .' '; ?> CERTIFICATE VERIFICATION CENTER</h4>
                    </b>
                </div>
            </div>

        </div>
        <form action="action.php" method="POST" class="p-3 mb-5"
            style="background-color: rgba(0,0,0,0.2); border-radius: 5px;">
            <div class="row mt-2">
                <div class="col-sm-12">
                    <label for="">Input Ref Number or Matric Number: </label>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <input type="text" id="fname" class="form-control" name="matricNumber"
                        placeholder="Input Ref or Matric Number" required>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm-12">
                    <button type="submit" name="verify" class="btn form-control text-white"
                        style="background-color: #4CAF50;">VERIFY</button>
                </div>
            </div>

        </form>
    </div>

</body>

</html>