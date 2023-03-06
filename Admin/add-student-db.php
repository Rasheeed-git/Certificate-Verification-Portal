<?php
require_once 'connection/connection_db.php'; 
// Select the last record from the table
$d_query = "SELECT * FROM Session_Tbl WHERE SessionStatus = 'Active' ORDER BY id DESC LIMIT 1";
$d_statement = $connect->prepare($d_query);
$d_statement->execute();
$d_result = $d_statement->fetch(PDO::FETCH_ASSOC);
$d_statement->closeCursor();
$std_session_id = $d_result['id'];

$std_fname = filter_input(INPUT_POST, 'fname');
$std_mname = filter_input(INPUT_POST, 'mname');
$std_lname = filter_input(INPUT_POST, 'lname');
$std_dept = filter_input(INPUT_POST, 'dept');
$std_grade = filter_input(INPUT_POST, 'grade');
$std_program = filter_input(INPUT_POST, 'program');
$std_gender = filter_input(INPUT_POST, 'gender');
$std_matricnumber = filter_input(INPUT_POST, 'matricnumber');
$std_refnumber = filter_input(INPUT_POST, 'refnumber');
$std_status = filter_input(INPUT_POST, 'status');
$std_year = filter_input(INPUT_POST, 'year');


    $std_info_query = "SELECT * FROM student_tbl WHERE matricnumber = :matric OR refnumber= :ref ";
    $std_info_statement = $connect->prepare($std_info_query);
    $std_info_statement->bindValue(':matric', $std_matricnumber);
    $std_info_statement->bindValue(':ref', $std_refnumber);
    $std_info_statement->execute();
    $std_info_row = $std_info_statement->fetch(PDO::FETCH_ASSOC);
    $std_info_statement->closeCursor();
    $std_check_matric = $std_info_row['matricnumber'];
    $std_check_ref = $std_info_row['refnumber'];



    if (isset($_POST["submit"])) {

        if ($std_check_matric === $std_matricnumber) {
            $errorstatusMsg = "Failed, Matric Number Exist";
            include 'add-student.php';
        }elseif($std_check_ref === $std_refnumber){

            $errorstatusMsg = "Failed, Ref Number exist";
            include 'add-student.php';
            
    } else {

        if($std_session_id == ""){

            $errorstatusMsg = "An error had occurred, Please Add Sessioon!";
            include 'add-student.php';

        }else{
                    //inserting into database
    
                    $std_query = "INSERT INTO student_tbl (session_id,fname, mname, lname, dept, grade, program, gender, matricnumber, refnumber, status, year) 
                    VALUES(:session_id,:fname, :mname, :lname, :dept, :grade, :program, :gender, :matricnumber, :refnumber, :status, :year)";
                    $std_statement = $connect->prepare($std_query);
                    $std_statement->bindValue(':session_id', $std_session_id);
                    $std_statement->bindValue(':fname', $std_fname);
                    $std_statement->bindValue(':mname', $std_mname);
                    $std_statement->bindValue(':lname', $std_lname);
                    $std_statement->bindValue(':dept', $std_dept);
                    $std_statement->bindValue(':grade', $std_grade);
                    $std_statement->bindValue(':program', $std_program);
                    $std_statement->bindValue(':gender', $std_gender);
                    $std_statement->bindValue(':matricnumber', $std_matricnumber);
                    $std_statement->bindValue(':refnumber', $std_refnumber);
                    $std_statement->bindValue(':status', $std_status);
                    $std_statement->bindValue(':year', $std_year);
                    $std_statement->execute();
                    $std_rowcount = $std_statement->rowCount();
                    $std_statement->closeCursor();
    
                    if ($std_rowcount == 1) {
                        $successstatusMsg = "Successfully, Your Record has been Inserted!";
                        include 'add-student.php';
    
                    } else {
                        $errorstatusMsg = "An error had occurred, please  try again later!";
                        include 'add-student.php';
                    }
    
                }    
    }
    

        
    
    }


?>