<?php
   
require 'connection/connection_db.php';

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
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/Index-style.css">
    <link rel="icon" href="data:image/;base64,<?php echo ($display_login_picture); ?>" type="image/*">
    <title>Admin | Log in</title>
</head>
<body>

    <section class='login' id='login'>
        <div class='head'>
            <img src="data:image/;base64,<?php echo ($display_verify_picture); ?>">
        </div>
        <?php if(isset($error_message)){?>
        <hr class="mt-2" />
        <div class="alert alert-danger left-icon-alert mt-4" role="alert">
            <strong>Oppss! </strong><?php echo htmlentities($error_message); ?>
        </div>
        <?php } ?>
        </p>
        <div class='form'>
            <form action="login-db.php" method="POST">
                <div class="input-block email">
                    <input id="login-user" name="username" type="text" placeholder="Username" />
                </div>
                <div class="input-block password">
                    <input type="password" name="password" id="login-password" placeholder="Password" />
                </div>
                <input type="submit" name="adminsubmit" class="btn-login" value="Login">
            </form>
        </div>
    </section>

</body>
</html>