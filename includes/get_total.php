<?php
include 'ip.php';
include 'db.php';
$ip = get_ip();
$get_order = "SELECT * FROM un_order WHERE ip='$ip'";
$run_order = mysqli_query($con, $get_order);
$sum = 0;
while ($row = mysqli_fetch_array($run_order)) {
    $pro_id = $row['product_id'];
    $count = $row['count'];
    $get_pro = "SELECT * FROM product WHERE id=$pro_id";
    $run_pro = mysqli_query($con, $get_pro);
    $row_pro = mysqli_fetch_array($run_pro);
    $pro_price = $row_pro['price'];
    $sum += ($count * $pro_price);
}
echo($sum);
?>