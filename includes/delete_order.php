<?php
include 'ip.php';
include 'db.php';
$id = $_GET['id'];
$ip = get_ip();
$get = "SELECT * FROM un_order WHERE ip='$ip' AND product_id='$id'";
$run = mysqli_query($con, $get);
$num = mysqli_num_rows($run);
if($num != 0){
    $delete = "DELETE FROM un_order WHERE product_id='$id' AND ip='$ip'";
    $run = mysqli_query($con, $delete);
    if($run){
        echo ("1");
    }else{
        echo ("0");
    }
}else{
    echo ("0");
}
?>