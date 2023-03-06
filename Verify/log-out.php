<?php
include_once('../Admin/connection/connection_db.php');
session_start();
session_destroy();
session_unset();

header("Location: index.php");
?>