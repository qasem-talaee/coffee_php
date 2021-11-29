<?php
include('db.php');
$id = $_GET['id'];
$status = $_GET['status'];
$update = "UPDATE c_table SET t_status='$status' WHERE id='$id'";
$run = mysqli_query($con, $update);
?>