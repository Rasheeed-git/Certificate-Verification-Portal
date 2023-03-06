<?php
require 'connection/connection_db.php';
$id =urldecode(base64_decode(filter_input(INPUT_GET, 'data')));
$prog = urldecode(base64_decode(filter_input(INPUT_GET, 'prog')));
 // Select the last Session from the table where is Active
 $session_query = "SELECT * FROM Session_Tbl WHERE id= '$id'";
 $session_statement = $connect->prepare($session_query);
 $session_statement->execute();
 $session_result = $session_statement->fetch(PDO::FETCH_ASSOC);
 $session_statement->closeCursor();
 $display_currentsession = $session_result['SessionName'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--style-->
    <?php include('includes/head.php'); ?>
    <link rel="stylesheet" href="" media="print">
    <!--style-->
    <style>
       @media print {
        .btn{
            display: none;
        }
       }
    </style>
</head>

<body>
    <div class="text-center">
    </div>
    <div class="">

    </div>


    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="d-inline">
                    <button onclick="window.print();" class="btn btn-primary float-right" id="print-btn">Print</button>
                    
                    <a href="list.php?pr_sid=<?= urlencode(base64_encode($id))?>&pr_prog=<?= urlencode(base64_encode($prog))?>">
                        <button class="btn btn-danger float-left" id="print-btn">back</button>
                    </a>
                </div>
                <table id="myTable" class="table table-bordered  print">
                    <caption style="caption-side: top; text-align: center; color:black;font:bolder">
                    <b style="font-size: 2em;">LIST OF VERIFIED <?php echo $prog. '\'S';?> STUDENT OF <?php echo $display_currentsession;?> SESSION </b></caption>

                    <thead class="thead-dark">
                        <tr>
                            <th style="width:4em;">#</th>
                            <th style="width:10em">Matric Number</th>
                            <th style="width:8em">Ref Number</th>
                            <th>Name</th>
                            <th style="width:18em">Grade</th>
                            <th style="width:5em">Year</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                
                $sn = 1;
                    // Select the data from the database
                    $query = "SELECT * FROM student_tbl WHERE session_id = '$id' AND program = '$prog'";
                    $stmt = $connect->prepare($query);
                    $stmt->execute();
                    $users = $stmt->fetchAll();
                    foreach($users as $row)
                    {
                ?>
                        <tr>
                            <td><?php echo $sn ?></td>
                            <td><?php echo $row['matricnumber']; ?></td>
                            <td><?php echo $row['refnumber']; ?></td>
                            <td><?php echo $row['fname'].' '.$row['lname'].' ' .$row['mname']; ?></td>
                            <td><?php echo $row['grade']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                        </tr>

                        <?php $sn++; } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?php 
    include('includes/script.php');
    include("includes/Webscript.php");
  ?>
</body>

</html>