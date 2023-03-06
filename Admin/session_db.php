<?php

   require 'connection/connection_db.php';
   $add_session_name = filter_input(INPUT_POST, 'add_session_name');
   $add_start_date = filter_input(INPUT_POST, 'add_start_date');
   $add_end_date = filter_input(INPUT_POST, 'add_end_date');


   $update_session_name = filter_input(INPUT_POST, 'update_session_name');
   $update_start_date = filter_input(INPUT_POST, 'update_start_date');
   $update_end_date = filter_input(INPUT_POST, 'update_end_date');
   $u_id = filter_input(INPUT_POST, 's_id');

    $active_session_id = filter_input(INPUT_POST, 'active_display_session');


     // Select the last Session from the table where is Active
  $session_query = "SELECT * FROM Session_Tbl";
  $session_statement = $connect->prepare($session_query);
  $session_statement->execute();
  $session_result = $session_statement->fetch(PDO::FETCH_ASSOC);
  $session_statement->closeCursor();
  $display_session = $session_result['SessionName'];

if (isset($add_session_name) && isset($add_start_date) && isset($add_end_date)) {

    if ($display_session != $add_session_name) {
        //Adding Session into Database
        if ($add_start_date > $add_end_date) {
            $date_error = "Start date Must be lessthan End date";
            include('session.php');

        } else {

            $query = "INSERT INTO Session_Tbl(SessionName, StartDate, EndDate, SessionStatus) 
            VALUES(:s_name, :s_date, :e_date,'In-Active')";

            $statement = $connect->prepare($query);
            $statement->bindValue(':s_name', $add_session_name);
            $statement->bindValue(':s_date', $add_start_date);
            $statement->bindValue(':e_date', $add_end_date);
            $statement->execute();
            $rowCount = $statement->rowCount();
            $statement->closeCursor();

            if ($rowCount == 1) {
                $insertsuccess = "Successfully, Your Record has been Inserted!";
                include("session.php");
            } else {
                $inserterror = 'An error had occurred, please check all input and try again!';
                include 'session.php';
            }
        }
    }else{
        $inserterror = 'Failed, Session Already Exist';
        include 'session.php';
    }

} elseif (isset($update_session_name) && isset($update_start_date) && isset($update_end_date) && isset($u_id)) {

    if ($display_session != $update_session_name) {
        //Updating Session into Database
        if ($update_start_date > $update_end_date) {
            $date_error = "Start date Must be lessthan End date";
            include('session.php');

        } else {

            if (isset($u_id)) {

                $query1 = "UPDATE Session_Tbl SET SessionName = :us_name,  StartDate = :us_date, EndDate = :ue_date WHERE id = :u_id";
                $statement1 = $connect->prepare($query1);
                $statement1->bindValue(':us_name', $update_session_name);
                $statement1->bindValue(':us_date', $update_start_date);
                $statement1->bindValue(':ue_date', $update_end_date);
                $statement1->bindValue(':u_id', $u_id);
                $statement1->execute();
                $rowCount1 = $statement1->rowCount();
                $statement1->closeCursor();

                if ($rowCount1 == 1) {
                    $updatesuccess = "Successfully, Your Record has been Updated!";
                    include("session.php");
                } else {
                    $updateerror = 'An error had occurred, please make sure you make changes before submitting!';
                    include 'session.php';
                }

            } else {
                header('Location: session.php');

            }
        }
    }else{
        $inserterror = 'Failed, Session Already Exist';
        include 'session.php';
    }
}elseif(isset($active_session_id)){

        $query2 = "UPDATE Session_Tbl SET SessionStatus = 'Active'  WHERE id = :u_id";
        $statement2 = $connect->prepare($query2);
        $statement2->bindValue(':u_id', $active_session_id);
        $statement2->execute();
        $statement2->closeCursor();

          // Select the data from the database
        $fetch = "SELECT * FROM Session_Tbl WHERE id = :id";
        $stmt = $connect->prepare($fetch);
        $stmt->bindParam(':id', $active_session_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Display the data in the input field
        $sessionname = $result['SessionName'];
        

        if ($statement2) {
            $activesuccess = 'Session ' .$sessionname. ' is Now Active';
        include ("session.php");
        } else {
            $activeerror ='An error had occurred, please try again later!';
            include 'session.php';
        }

   
}
?>