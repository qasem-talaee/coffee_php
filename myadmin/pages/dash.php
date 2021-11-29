<script>
    function reload_page(){
        location.reload();
    }
    window.setInterval(reload_page, 10000);
    function table_chnage(id){
        var x = document.getElementById("table_" + id).value;
        $.ajax({
            method: 'get',
            url: 'includes/table_change.php',
            data: {
              id: id,
              status: x,
            },
            success: function(data){
              if(x == "0"){
                document.getElementById("s_table_" + id).innerHTML = '<div class="badge badge-danger p-2">میز پر است</div>';
              }else{
                document.getElementById("s_table_" + id).innerHTML = '<div class="badge badge-success p-2">میز خالی است</div>';
              }
            }
        });
    }
    function change_order(id){
        Swal.fire({
        title: 'آیا می خواهید وضعیت سفارش را به تمام شده تغییر دهید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله تغییر بده'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'get',
              url: 'includes/change_order.php',
              data:{
                table: id,
              },
              success: function(){
                location.reload();
              }
            });
          }
        });
    }
</script>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">داشبورد</p>
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
                    <h4 class="card-title mb-sm-0">وضعیت میزها</h4>
                    <a href="?table" class="text-dark ml-auto mb-3 mb-sm-0"> مدیریت میزها</a>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table text-right">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">تغییر وضعیت</th>
                                <th class="font-weight-bold">وضعیت</th>
                                <th class="font-weight-bold">نام</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get_table = "SELECT * FROM c_table";
                            $run_table = mysqli_query($con, $get_table);
                            while($row_table = mysqli_fetch_array($run_table)){
                                $t_name = $row_table['name'];
                                $t_id = $row_table['id'];
                                $t_status = $row_table['t_status'];
                                ?>
                                <tr>
                                    <td>
                                        <select id="table_<?php echo($t_id); ?>" class="form-control form-control-lg text-right" onchange="table_chnage(<?php echo($t_id); ?>)">
                                            <option value="1" <?php if($t_status == "1"){echo("selected");} ?>>خالی</option>
                                            <option value="0" <?php if($t_status == "0"){echo("selected");} ?>>پر</option>
                                        </select>
                                    </td>
                                    <td id="s_table_<?php echo($t_id); ?>">
                                        <?php
                                        if($t_status == "0"){
                                            echo('<div class="badge badge-danger p-2">میز پر است</div>');
                                        }else{
                                            echo('<div class="badge badge-success p-2">میز خالی است</div>');
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo($t_name); ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex align-items-center mb-4">
                    <h4 class="card-title mb-sm-0">سفارشات تکمیل نشده</h4>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$get_t = "select table_id,status from orders group by table_id having status='0'";
$run_t = mysqli_query($con, $get_t);
while($row_t = mysqli_fetch_array($run_t)){
    $table_id = $row_t['table_id'];
    $get_table = "SELECT * FROM c_table WHERE id='$table_id'";
    $run_table = mysqli_query($con, $get_table);
    $row_table = mysqli_fetch_array($run_table);
    $table_name = $row_table['name'];
    ?>
    <div class="row" id="order_<?php echo($table_id); ?>">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <button type="button" class="btn btn-group-lg btn-primary" onclick="change_order(<?php echo($table_id); ?>)">تغییر وضعیت</button>
                        <p class="text-dark ml-auto mb-3 mb-sm-0"> <?php echo($table_name); ?></p>
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table class="table text-right">
                            <thead>
                                <tr>
                                    <th class="font-weight-bold">قیمت کل</th>
                                    <th class="font-weight-bold">قیمت</th>
                                    <th class="font-weight-bold">تعداد</th>
                                    <th class="font-weight-bold">سفارش</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $get_order = "SELECT * FROM orders WHERE table_id='$table_id' AND status='0'";
                                $run_order = mysqli_query($con, $get_order);
                                $sum = 0;
                                while($row_order = mysqli_fetch_array($run_order)){
                                    $pro_id = $row_order['product_id'];
                                    $count = $row_order['count'];
                                    $get_pro = "SELECT * FROM product WHERE id='$pro_id'";
                                    $run_pro = mysqli_query($con, $get_pro);
                                    $row_pro = mysqli_fetch_array($run_pro);
                                    $pro_name = $row_pro['name'];
                                    $pro_price = $row_pro['price'];
                                    $sum += ($count * $pro_price);
                                ?>
                                <tr>
                                    <td><?php echo($count * $pro_price); ?></td>
                                    <td><?php echo($pro_price); ?></td>
                                    <td><?php echo($count); ?></td>
                                    <td><?php echo($pro_name); ?></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="d-flex mt-4 flex-wrap">
                            <p class="text-muted"></p>
                            <nav class="ml-auto">
                                <ul class="pagination separated pagination-info">
                                    <li class="page-item"><a class="btn btn-info" style="font-size:1.5em;">جمع کل : <?php echo($sum); ?> تومان</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>