<?php
$per_page = 20;
$get_all = "SELECT * FROM orders WHERE status='1'";
$run_all = mysqli_query($con, $get_all);
$count_all = mysqli_num_rows($run_all);
$count_page = floor(($count_all / $per_page)) + 1;
if(!isset($_GET['page'])){
    $page = 1;
    $start = 0;
}else{
    $page = $_GET['page'];
    $start = ($page - 1) * $per_page;
}
$get = "SELECT * FROM orders WHERE status='1' ORDER BY date DESC LIMIT $start, $per_page";
$run = mysqli_query($con, $get);
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">سفارشات تکمیل شده</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">سفارشات</h4>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table text-right">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">تاریخ</th>
                                <th class="font-weight-bold">قیمت کل</th>
                                <th class="font-weight-bold">قیمت</th>
                                <th class="font-weight-bold">تعداد</th>
                                <th class="font-weight-bold">میز</th>
                                <th class="font-weight-bold">نام محصول</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($run)){
                                $pro_id = $row['product_id'];
                                //
                                $get_pro = "SELECT * FROM product WHERE id = '$pro_id'";
                                $run_pro = mysqli_query($con, $get_pro);
                                $row_pro = mysqli_fetch_array($run_pro);
                                $name = $row_pro['name'];
                                $price = $row_pro['price'];
                                //
                                $count = $row['count'];
                                $table_id = $row['table_id'];
                                //
                                $get_table = "SELECT * FROM c_table WHERE id='$table_id'";
                                $run_table = mysqli_query($con, $get_table);
                                $row_table = mysqli_fetch_array($run_table);
                                $table_name = $row_table['name'];
                                //
                                $date = $row['date'];
                                ?>
                            <tr>
                                <td><?php echo($date); ?></td>
                                <td><?php echo(($price * $count)); ?></td>
                                <td><?php echo($price); ?></td>
                                <td><?php echo($count); ?></td>
                                <td><?php echo($table_name); ?></td>
                                <td><?php echo($name); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex mt-4 flex-wrap">
                    <nav class="ml-auto">
                        <ul class="pagination separated pagination-info">
                            <?php
                            for($i=1; $i<=$count_page; $i++){
                            ?>
                            <li class="page-item <?php if($page == $i){echo('active');} ?>"><a href="?order&page=<?php echo($i); ?>" class="page-link"><?php echo($i); ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>