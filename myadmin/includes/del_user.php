<?php
include('db.php');
$id = $_GET['id'];
$del = "DELETE FROM users WHERE id='$id'";
$run = mysqli_query($con, $del);
?>