<?php
    session_start();
    
    include '../Admin/connection/connection_db.php';
    
	$std_matric = $_POST["matricNumber"];
    // Select all User Information
    $std_info_query = "SELECT * FROM student_tbl WHERE matricnumber = :matric OR refnumber = :ref";
    $std_info_statement=$connect->prepare($std_info_query);
    $std_info_statement->bindValue(':matric', $std_matric);
	$std_info_statement->bindValue(':ref', $std_matric);
    $std_info_statement->execute();
    $std_info_row = $std_info_statement->fetch(PDO::FETCH_ASSOC);
    $std_info_statement->closeCursor();
 

    if(isset($_POST['verify'])){

    if ($std_info_row) {
        // user information
        
        $_SESSION['dept'] = $std_info_row['dept'];
        $_SESSION['fname'] = $std_info_row['fname'];
        $_SESSION['lname'] = $std_info_row['lname'];
        $_SESSION['mname'] = $std_info_row['mname'];
        $_SESSION['fullname'] = $_SESSION['fname'] . ' ' . $_SESSION['lname'] . ' ' .  $_SESSION['mname'];
        $_SESSION['year'] = $std_info_row['year'];
        $_SESSION['grade'] = $std_info_row['grade'];
        $_SESSION['status'] = $std_info_row['status'];
        $_SESSION['program'] = $std_info_row['program'];
        $_SESSION['matric'] = $std_info_row['matricnumber'];
    


        header('Location: student-verification.php');
    }else {
        $_SESSION['notverified'] = "Not Verified";

        header('Location: student-verification.php');
            
        }        

}     
?>