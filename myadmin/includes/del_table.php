<?php
include('db.php');
$id = $_GET['id'];
$del = "DELETE FROM c_table WHERE id='$id'";
$run = mysqli_query($con, $del);
?>