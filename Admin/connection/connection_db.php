<?php 
 $user = 'root';
 $p_word = '';
 $host='localhost';
 $database='VerificationDB';

 $dsn="mysql:host=$host;dbname=$database;";


 try {
    $connect = new PDO($dsn, $user, $p_word);
    #echo '<h1>Connection successful.</h1>';
 } catch(PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
 }
?>