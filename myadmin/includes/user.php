<?php
include('includes/db.php');
$email = $_SESSION['email'];
$get_user = "SELECT * FROM users WHERE email='$email'";
$run_user = mysqli_query($con, $get_user);
$row_user = mysqli_fetch_array($run_user);
$name = $row_user['name'];
$user_status = $row_user['status'];
?>