<?php
session_start();
include 'db_connect.php';

$user_id = $_SESSION['senior_id'];
$session_no = $_SESSION['session_no'];

$out_date = date("d/m/Y");
$out_time = date("H:i:s");

mysqli_query($conn, "UPDATE senior_tbl SET status='Inactive' WHERE senior_id='$user_id'");

mysqli_query($conn, "UPDATE senior_log SET out_time='$out_time', out_date='$out_date' WHERE senior_id='$user_id' AND session_no='$session_no'");


unset($_SESSION['senior_status']);

unset($_SESSION['senior_name']);

unset($_SESSION['senior_id']);

unset($_SESSION['session_no']);

header("Location: index.php"); // Then you will go back to the index.php
?>