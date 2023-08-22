<?php
session_start();
date_default_timezone_set("Asia/Manila");

$admin_id = $_SESSION['admin_id'];
#$session_no = $_SESSION['session_no'];

$out_date = date("d/m/Y");
$out_time = date("H:i:s");
$status = "Inactive";

/*
#prepared statement to update senior status to inactive
$stat_stmt = $conn->prepare("UPDATE admin_tbl SET status=? WHERE admin_id=?");
$stat_stmt->bind_param("si", $status, $admin_id);
$stat_stmt->execute();
*/

#prepared statement to update senior log
/*
$log_stmt = $conn->prepare("UPDATE log_tbl SET out_time=?, out_date=? WHERE senior_id=? AND session_no=?");
$log_stmt->bind_param("ssii", $out_time, $out_date, $senior_id, $session_no);
$log_stmt->execute();
*/


#these will make sure that the only session to be destroyed are your sessions and not other sessions
unset($_SESSION['admin_status']);

unset($_SESSION['admin_email']);

unset($_SESSION['admin_id']);

#unset($_SESSION['session_no']);

header("Location: index.php"); // Then you will go back to the index.php

?>