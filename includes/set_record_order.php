<?php
include 'ip.php';
include 'db.php';
$ip = get_ip();
$table_id = $_GET['table'];
$get = "SELECT * FROM un_order WHERE ip='$ip'";
$run = mysqli_query($con, $get);
$flag = 1;
while($row = mysqli_fetch_array($run)){
    $product_id = $row['product_id'];
    $count = $row['count'];
    $insert = "INSERT INTO `orders` (`id`, `table_id`, `product_id`, `status`, `count`, `date`) VALUES (NULL, '$table_id', '$product_id', '0', '$count', NOW())";
    $run_insert = mysqli_query($con, $insert);
    if(!$run_insert){
        $flag = 0;
    }
}
if($flag == 1){
    $delete = "DELETE FROM un_order WHERE ip='$ip'";
    $run = mysqli_query($con, $delete);
    $update = "UPDATE `c_table` SET `t_status` = '0' WHERE `c_table`.`id` = $table_id";
    $run = mysqli_query($con, $update);
}
?>