<?php

require 'connection/connection_db.php';
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
$std_matric_id = filter_input(INPUT_POST, 'matric_number');
$std_delete_matric = filter_input(INPUT_POST, 'delete-matric-number');
$session_id = filter_input(INPUT_POST, 'session_id');
$program = filter_input(INPUT_POST, 'program');
$del_session_id = filter_input(INPUT_POST, 'del_session_id');
$del_prog = filter_input(INPUT_POST, 'del_prog');

    $std_info_query = "SELECT * FROM student_tbl WHERE matricnumber = :matric OR refnumber= :ref ";
    $std_info_statement = $connect->prepare($std_info_query);
    $std_info_statement->bindValue(':matric', $std_matricnumber);
    $std_info_statement->bindValue(':ref', $std_refnumber);
    $std_info_statement->execute();
    $std_info_row = $std_info_statement->fetch(PDO::FETCH_ASSOC);
    $std_info_statement->closeCursor();
    $std_check_matric = $std_info_row['matricnumber'];
    $std_check_ref = $std_info_row['refnumber'];

    if (isset($_POST["update"])) {
        $std_query = "UPDATE student_tbl SET fname = :fname, mname = :mname, lname = :lname,
                 dept =:dept, grade= :grade, program = :program, gender = :gender,
                  matricnumber= :matricnumber, refnumber=:refnumber, status =:status, year=:year WHERE matricnumber = '$std_matric_id'";
        $std_statement = $connect->prepare($std_query);
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
            $action_session_id = $session_id;
            $new_program = $program;
            $successstatusMsg = "Successfully, Your Record has been Updated!.";

            include 'action-page.php';

        } else {
            $action_session_id = $session_id;
            $new_program = $program;
            $errorstatusMsg = "Failed, No changes was Made or Nothing to Update.";
            include 'action-page.php';
        }







    } elseif (isset($_POST["delete"])) {


        $std_del_query = "DELETE  FROM student_tbl WHERE matricnumber = '$std_delete_matric'";
        $std_del_statement = $connect->prepare($std_del_query);
        $std_del_statement->execute();
        $std_del_rowcount = $std_del_statement->rowCount();
        $std_del_statement->closeCursor();

        if ($std_del_rowcount > 0) {
            $action_session_id = $del_session_id;
            $new_program = $del_prog;
            $successstatusMsg = "Successfully, Your Record has been Deleted!.";
            include 'action-page.php';

        } else {
            $action_session_id = $del_session_id;
            $new_program = $del_prog;
            $errorstatusMsg = "Failed to Delete Record, No Record to Delete.";
            include 'action-page.php';
        }

    }
?>