<script>
    function del(id){
        Swal.fire({
        title: 'از این کار اطمینان کامل دارید؟اطلاعات بعد از حذف قابل بازیابی نیست',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله حذف کن'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'get',
              url: 'includes/del_table.php',
              data:{
                id: id,
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
                <p class="mb-lg-0 text-center">میزها</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <a class="mb-lg-0 text-center btn btn-primary" href="?add_table">اضافه کردن میز جدید</a>
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
                    <h4 class="card-title mb-sm-0">میزها</h4>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table text-right">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">حذف</th>
                                <th class="font-weight-bold">ویرایش</th>
                                <th class="font-weight-bold">نام</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get = "SELECT * FROM c_table";
                            $run = mysqli_query($con, $get);
                            while($row = mysqli_fetch_array($run)){
                                $id = $row['id'];
                                $name = $row['name']; 
                            ?>
                            <tr>
                                <td><button type="button" class="btn btn-danger" onclick="del(<?php echo($id); ?>)">حذف</button></td>
                                <td><a class="btn btn-primary" href="?edit_table&id=<?php echo($id); ?>">ویرایش</a></td>
                                <td><?php echo($name); ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>