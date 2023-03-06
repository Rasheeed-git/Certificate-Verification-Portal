<?php
    session_start();
    require 'connection/connection_db.php';

    $login_user = filter_input(INPUT_POST, 'username');
    $login_pass = filter_input(INPUT_POST, 'password');

    if(isset($_POST['adminsubmit'])){

    $login_query = "SELECT * FROM User_tbl WHERE username = :username";
    $login_statement=$connect->prepare($login_query);
    $login_statement->bindValue(':username', $login_user);
    $login_statement->execute();
    $login_row = $login_statement->fetch(PDO::FETCH_ASSOC);
    $login_statement->closeCursor();

    if($login_row === false) {
        $error_message = "Invalid Username!";
        include('login.php');
        
    } else {
        if(password_verify($login_pass, $login_row['password'])) {
            $_SESSION['user_id'] = $login_row['id'];

            header('Location: student-verification.php');
        } else {
            $error_message = 'Invalid Password!';
            include('login.php');
        }
    }

}     
?>