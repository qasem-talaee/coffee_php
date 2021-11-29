<?php
include 'ip.php';
include 'db.php';
$id = $_GET['id'];
$ip = get_ip();
$get = "SELECT * FROM un_order WHERE ip='$ip' AND product_id='$id'";
$run = mysqli_query($con, $get);
$num = mysqli_num_rows($run);
if($num != 0){
    $row = mysqli_fetch_array($run);
    $count = $row['count'];
    $new = $count + 1;
    $update = "UPDATE un_order SET count=$new WHERE ip='$ip' AND product_id='$id'";
    $run_u = mysqli_query($con, $update);
    if ($run_u){
        echo ("1");
    }else{
        echo ("0");
    }
}else{
    $insert = "INSERT INTO un_order (ip, product_id, count) values ('$ip', '$id', '1')";
    $run_i = mysqli_query($con, $insert);
    if ($run_i){
        echo ("1");
    }else{
        echo ("0");
    }
}
?>