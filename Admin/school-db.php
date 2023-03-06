<?php 
// Include the database configuration file  
require 'connection/connection_db.php'; 
 
//If file upload form is submitted 
if(isset($_POST["updatesubmit"])){ 

          // Get input info 
          $school_name = filter_input(INPUT_POST, 'update_school_name');

    if(!empty(($_FILES['limage']['tmp_name']) && $_FILES['vimage']['tmp_name'])) {


         // Get file info 
         $l_fileName = basename($_FILES["limage"]["name"]); 
         $l_fileType = pathinfo($l_fileName, PATHINFO_EXTENSION); 
 
         $v_fileName = basename($_FILES["vimage"]["name"]); 
         $v_fileType = pathinfo($v_fileName, PATHINFO_EXTENSION); 
          
         // Allow certain file formats 
         $l_allowTypes = array('jpg','png','jpeg','gif');
         $v_allowTypes = array('jpg','png','jpeg','gif');
 
     
         $l_file_size =$_FILES['limage']['size'];
         $v_file_size =$_FILES['vimage']['size'];
 
         if ((($l_file_size && $v_file_size) <= 5242880)) {
             if ((in_array($l_fileType, $l_allowTypes)) && (in_array($v_fileType, $v_allowTypes))) {
 
                 $l_image = $_FILES['limage']['tmp_name'];
                 $l_imgContent = base64_encode(file_get_contents(($l_image)));
                 $v_image = $_FILES['vimage']['tmp_name'];
                 $v_imgContent = base64_encode(file_get_contents($v_image));
 
                 $img_query = "UPDATE School_tbl SET  loginimage = '$l_imgContent', verifyimage= '$v_imgContent' WHERE id=1";
                 //$img_query = "INSERT INTO School_tbl (id,schoolname,loginimage,verifyimage) VALUES (NULL,'$school_name','$l_imgContent','$v_imgContent')";
                 $img_statement = $connect->prepare($img_query);
                 $img_statement->execute();
                 $img_rowCount = $img_statement->rowCount();
                 $img_statement->closeCursor();
 
                 if ($img_rowCount == 1) {
                     $insertsuccess = 'Successfully, Your Record has been Updated!';
                     include 'school.php';
                 } else {
                     $inserterror = 'An error had occurred, please check all input and try again!';
                     include 'school.php';
                 }
 
             } else {
                 $inserterror = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                 include 'school.php';
 
             }
         }else{
             $inserterror = 'Failed, Image must be lessthan or equal to 5mb';
             include 'school.php';
         }
    

    }elseif(!empty(($_FILES['limage']['tmp_name']))){

         // Get file info 
         $l_fileName = basename($_FILES["limage"]["name"]); 
         $l_fileType = pathinfo($l_fileName, PATHINFO_EXTENSION); 
 
       
          
         // Allow certain file formats 
         $l_allowTypes = array('jpg','png','jpeg','gif');
       
 
     
         $l_file_size =$_FILES['limage']['size'];
      
 
         if ((($l_file_size) <= 5242880)) {
             if ((in_array($l_fileType, $l_allowTypes))) {
 
                 $l_image = $_FILES['limage']['tmp_name'];
                 $l_imgContent = base64_encode(file_get_contents(($l_image)));
                 
 
                 $img_query = "UPDATE School_tbl SET  loginimage = '$l_imgContent' WHERE id=1";
                 //$img_query = "INSERT INTO School_tbl (id,schoolname,loginimage,verifyimage) VALUES (NULL,'$school_name','$l_imgContent','$v_imgContent')";
                 $img_statement = $connect->prepare($img_query);
                 $img_statement->execute();
                 $img_rowCount = $img_statement->rowCount();
                 $img_statement->closeCursor();
 
                 if ($img_rowCount == 1) {
                     $insertsuccess = 'Successfully, Your Record has been Updated!';
                     include 'school.php';
                 } else {
                     $inserterror = 'An error had occurred, please check all input and try again!';
                     include 'school.php';
                 }
 
             } else {
                 $inserterror = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                 include 'school.php';
 
             }
         }else{
             $inserterror = 'Failed, Image must be lessthan or equal to 5mb';
             include 'school.php';
         }
    

    }elseif(!empty(($_FILES['vimage']['tmp_name']))){

       
 
         $v_fileName = basename($_FILES["vimage"]["name"]); 
         $v_fileType = pathinfo($v_fileName, PATHINFO_EXTENSION); 
          
         // Allow certain file formats 

         $v_allowTypes = array('jpg','png','jpeg','gif');
 
     
   
         $v_file_size =$_FILES['vimage']['size'];
 
         if ((($v_file_size) <= 5242880)) {
             if ((in_array($v_fileType, $v_allowTypes))) {
 
               
                 $v_image = $_FILES['vimage']['tmp_name'];
                 $v_imgContent = base64_encode(file_get_contents($v_image));
 
                 $img_query = "UPDATE School_tbl SET verifyimage= '$v_imgContent' WHERE id=1";
                 //$img_query = "INSERT INTO School_tbl (id,schoolname,loginimage,verifyimage) VALUES (NULL,'$school_name','$l_imgContent','$v_imgContent')";
                 $img_statement = $connect->prepare($img_query);
                 $img_statement->execute();
                 $img_rowCount = $img_statement->rowCount();
                 $img_statement->closeCursor();
 
                 if ($img_rowCount == 1) {
                     $insertsuccess = 'Successfully, Your Record has been Updated!';
                     include 'school.php';
                 } else {
                     $inserterror = 'An error had occurred, please check all input and try again!';
                     include 'school.php';
                 }
 
             } else {
                 $inserterror = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                 include 'school.php';
 
             }
         }else{
             $inserterror = 'Failed, Image must be lessthan or equal to 5mb';
             include 'school.php';
         }
    

    }elseif(!empty($school_name)){

 
                 $img_query = "UPDATE School_tbl SET schoolname = '$school_name' WHERE id=1";
                 //$img_query = "INSERT INTO School_tbl (id,schoolname,loginimage,verifyimage) VALUES (NULL,'$school_name','$l_imgContent','$v_imgContent')";
                 $img_statement = $connect->prepare($img_query);
                 $img_statement->execute();
                 $img_rowCount = $img_statement->rowCount();
                 $img_statement->closeCursor();
 
                 if ($img_rowCount == 1) {
                     $insertsuccess = 'Successfully, Your Record has been Updated!';
                     include 'school.php';
                 } else {
                     $inserterror = 'An error had occurred, No changes was Made!';
                     include 'school.php';
                 }


    }else{



         // Get file info 
         $l_fileName = basename($_FILES["limage"]["name"]); 
         $l_fileType = pathinfo($l_fileName, PATHINFO_EXTENSION); 
 
         $v_fileName = basename($_FILES["vimage"]["name"]); 
         $v_fileType = pathinfo($v_fileName, PATHINFO_EXTENSION); 
          
         // Allow certain file formats 
         $l_allowTypes = array('jpg','png','jpeg','gif');
         $v_allowTypes = array('jpg','png','jpeg','gif');
 
     
         $l_file_size =$_FILES['limage']['size'];
         $v_file_size =$_FILES['vimage']['size'];
 
         if ((($l_file_size && $v_file_size) <= 5242880)) {
             if ((in_array($l_fileType, $l_allowTypes)) && (in_array($v_fileType, $v_allowTypes))) {
 
                 $l_image = $_FILES['limage']['tmp_name'];
                 $l_imgContent = base64_encode(file_get_contents(($l_image)));
                 $v_image = $_FILES['vimage']['tmp_name'];
                 $v_imgContent = base64_encode(file_get_contents($v_image));
 
                 $img_query = "UPDATE School_tbl SET schoolname = '$school_name', loginimage = '$l_imgContent', verifyimage= '$v_imgContent' WHERE id=1";
                 //$img_query = "INSERT INTO School_tbl (id,schoolname,loginimage,verifyimage) VALUES (NULL,'$school_name','$l_imgContent','$v_imgContent')";
                 $img_statement = $connect->prepare($img_query);
                 $img_statement->execute();
                 $img_rowCount = $img_statement->rowCount();
                 $img_statement->closeCursor();
 
                 if ($img_rowCount == 1) {
                     $insertsuccess = 'Successfully, Your Record has been Updated!';
                     include 'school.php';
                 } else {
                     $inserterror = 'An error had occurred, please check all input and try again!';
                     include 'school.php';
                 }
 
             } else {
                 $inserterror = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                 include 'school.php';
 
             }
         }else{
             $inserterror = 'Failed, Image must be lessthan or equal to 5mb';
             include 'school.php';
         }
    

    }


    
 
 
    
       
        
    
}
?>