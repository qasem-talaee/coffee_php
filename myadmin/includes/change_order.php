<?php
include('db.php');
$table_id = $_GET['table'];
$update = "UPDATE orders SET status='1' WHERE table_id='$table_id' AND status='0'";
$run = mysqli_query($con, $update);
$update_table = "UPDATE c_table SET t_status='1' WHERE id='$table_id'";
$run_table = mysqli_query($con, $update_table);
?>