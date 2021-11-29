<?php
include 'ip.php';
include 'db.php';
$id = $_GET['id'];
$new = $_GET['new'];
$ip = get_ip();
$get = "SELECT * FROM un_order WHERE ip='$ip' AND product_id='$id'";
$run = mysqli_query($con, $get);
$num = mysqli_num_rows($run);
if($num != 0){
    $update = "UPDATE un_order SET count=$new WHERE ip='$ip' AND product_id='$id'";
    $run = mysqli_query($con, $update);
    if($run){
        $get = "SELECT * from product WHERE id='$id'";
        $run = mysqli_query($con, $get);
        $row = mysqli_fetch_array($run);
        $price = $row['price'];
        echo($price);
    }
}
?>