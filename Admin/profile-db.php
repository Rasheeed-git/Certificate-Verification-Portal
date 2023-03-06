<?php
require 'connection/connection_db.php';
$user_old_password = filter_input(INPUT_POST, 'old_password');
$user_new_password = filter_input(INPUT_POST, 'new_password');
$user_confirm_password = filter_input(INPUT_POST, 'confirm_password');

$user_fname = filter_input(INPUT_POST, 'fname');
$user_lname = filter_input(INPUT_POST, 'lname');
$user_username = filter_input(INPUT_POST, 'username');
$user_email = filter_input(INPUT_POST, 'email');
$user_contact = filter_input(INPUT_POST, 'contact');
$user_address = filter_input(INPUT_POST, 'address');
$user_role = filter_input(INPUT_POST, 'role');
$user_gender = filter_input(INPUT_POST, 'gender');

$user_id = filter_input(INPUT_POST, 'user_id');
$user_update_id = filter_input(INPUT_POST, 'user_update_id');
$user_picture_id = filter_input(INPUT_POST, 'user_picture_id');



if (isset($_POST["change_password"])) {

    // Select the data from the database
    $query = "SELECT * FROM User_tbl WHERE id = :id";
    $stmt = $connect->prepare($query);
    $stmt->bindValue(':id', $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $db_pass = $result['password'];
    $pass = ($user_new_password == $user_confirm_password);
    $enc_pass = password_hash($user_new_password, PASSWORD_BCRYPT);

    if (password_verify($user_old_password, $db_pass)) {

        if ($pass) {

            $pass_query = "UPDATE User_tbl SET password = '$enc_pass'";
            $exe = $connect->prepare($pass_query);
            $exe->execute();
            $exe->closeCursor();

            if ($exe) {
                $messagesuccess = "Successfully, Your Record has been Updated!.";
                include 'profile.php';
            } else {
                $messageerror = "An error had occurred, please try again later!";
                include 'profile.php';
            }
        } else {
            $messageerror = "Failed, Password must match";
            include 'profile.php';
        }
    } else {
        $messageerror = "Failed, Old Password doesn't Exist!";
        include 'profile.php';
    }
}elseif(isset($_POST["update"])){
    
    $file_size =$_FILES['image']['size'];

    if (($file_size <= 5242880)) {

        if (!empty($_FILES["image"]["name"])) {

            // Get file info 
            $std_fileName = basename($_FILES["image"]["name"]);
            $std_fileType = pathinfo($std_fileName, PATHINFO_EXTENSION);

            // Allow certain file formats 
            $std_allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array($std_fileType, $std_allowTypes)) {
                $std_image = $_FILES['image']['tmp_name'];
                $std_imgContent = addslashes(file_get_contents($std_image));

                //inserting into database

                $user_query = "UPDATE User_tbl SET fname = :fname, lname = :lname,
                username = :user, email=:email, contact=:contact, address=:address, role=:role,
                 gender=:gender,image='$std_imgContent'
                 WHERE id = '$user_update_id'";
                $user_statement = $connect->prepare($user_query);
                $user_statement->bindValue(':fname', $user_fname);
                $user_statement->bindValue(':lname', $user_lname);
                $user_statement->bindValue(':user', $user_username);
                $user_statement->bindValue(':email', $user_email);
                $user_statement->bindValue(':contact', $user_contact);
                $user_statement->bindValue(':address', $user_address);
                $user_statement->bindValue(':role', $user_role);
                $user_statement->bindValue(':gender', $user_gender);
                $user_statement->execute();
                $user_rowcount = $user_statement->rowCount();
                $user_statement->closeCursor();


                if ($user_rowcount == 1) {
                    $messagesuccess = "Successfully, Your Record has been Updated!.";
                    include 'profile.php';

                } else {
                    $messageerror = "An error had occurred, No Changes was Made!";
                    include 'profile.php';
                }


            } else {

                $messageerror = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                include 'profile.php';

            }


        } elseif((empty($_FILES["image"]["name"]))) {

                //inserting into database

                $user_query = "UPDATE User_tbl SET fname = :fname, lname = :lname,
                username = :user, email=:email, contact=:contact, address=:address, role=:role,
                 gender=:gender
                 WHERE id = '$user_update_id'";
                $user_statement = $connect->prepare($user_query);
                $user_statement->bindValue(':fname', $user_fname);
                $user_statement->bindValue(':lname', $user_lname);
                $user_statement->bindValue(':user', $user_username);
                $user_statement->bindValue(':email', $user_email);
                $user_statement->bindValue(':contact', $user_contact);
                $user_statement->bindValue(':address', $user_address);
                $user_statement->bindValue(':role', $user_role);
                $user_statement->bindValue(':gender', $user_gender);
                $user_statement->execute();
                $user_rowcount = $user_statement->rowCount();
                $user_statement->closeCursor();


                if ($user_rowcount == 1) {
                    $messagesuccess = "Successfully, Your Record has been Updated!.";
                    include 'profile.php';

                } else {
                    $messageerror = "An error had occurred, No Changes was Made!";
                    include 'profile.php';
                }

        }
    }else{
        $messageerror = "File must be lessthan or equal to 5mb";
        include 'profile.php';
    }
                
}
?>