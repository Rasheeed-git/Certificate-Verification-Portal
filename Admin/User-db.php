<?php 
// Include the database configuration file  
require 'connection/connection_db.php'; 
 
//If file upload form is submitted 
if(isset($_POST["submit"])){ 
    
        // Get input info 
        $u_first_name = filter_input(INPUT_POST, 'fname');
        $u_last_name = filter_input(INPUT_POST, 'lname');
        $u_username = filter_input(INPUT_POST, 'uname');
        $u_role = filter_input(INPUT_POST, 'role');
        $u_email = filter_input(INPUT_POST, 'email');
        $u_address = filter_input(INPUT_POST, 'address');
        $u_contact = filter_input(INPUT_POST, 'contact');
        $u_gender = filter_input(INPUT_POST, 'gender');
        $u_password = filter_input(INPUT_POST, 'pword');
        $u_cpassword = filter_input(INPUT_POST, 'cpword');
    
        // Get file info 
        $u_fileName = basename($_FILES["image"]["name"]); 
        $u_fileType = pathinfo($u_fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $u_allowTypes = array('jpg','png','jpeg','gif');
    if (($u_password == $u_cpassword)) {
        $file_size =$_FILES['image']['size'];

        if (($file_size <= 5242880)) {
            if (in_array($u_fileType, $u_allowTypes)) {

                $u_pass = password_hash($u_password, PASSWORD_BCRYPT);
                $u_image = $_FILES['image']['tmp_name'];

                
                $u_imgContent = addslashes(file_get_contents($u_image));

                $u_query = "INSERT INTO User_tbl (fname, lname, username, password, email, contact, address, role, gender, image) 
                VALUES(:first_name, :last_name, :username, :u_password, :u_email, :u_contact, :u_address, :u_role, :u_gender, '$u_imgContent')";

                $u_statement = $connect->prepare($u_query);
                $u_statement->bindValue(':first_name', $u_first_name);
                $u_statement->bindValue(':last_name', $u_last_name);
                $u_statement->bindValue(':username', $u_username);
                $u_statement->bindValue(':u_password', $u_pass);
                $u_statement->bindValue(':u_email', $u_email);
                $u_statement->bindValue(':u_contact', $u_contact);
                $u_statement->bindValue(':u_address', $u_address);
                $u_statement->bindValue(':u_role', $u_role);
                $u_statement->bindValue(':u_gender', $u_gender);
                $u_statement->execute();
                $u_rowCount = $u_statement->rowCount();
                $u_statement->closeCursor();

                if ($u_rowCount == 1) {
                    $successstatusMsg = 'Successfully, Your Record has been Inserted!';
                    include 'User.php';
                } else {
                    $errorstatusMsg = 'An error had occurred, please check all input and try again!';
                    include 'User.php';
                }

            } else {
                $errorstatusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                include 'User.php';

            }
        }else{
            $errorstatusMsg = 'Failed, Image must be  lessthan or equal to 5mb';
            include 'User.php';
        }
    }else{
        $errorstatusMsg = 'Failed, Password must match';
        include 'User.php';
    }
        
    
}
?>