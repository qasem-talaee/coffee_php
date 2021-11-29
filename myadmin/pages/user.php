<?php
if($user_status != 'admin'){
    echo('<script>window.location.replace("index.php");</script>');
}
?>
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
              url: 'includes/del_user.php',
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
                <p class="mb-lg-0 text-center">کارمندان</p>
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
                <a class="mb-lg-0 text-center btn btn-primary" href="?add_user">اضافه کردن کارمند جدید</a>
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
                    <h4 class="card-title mb-sm-0">کارمندان</h4>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table text-right">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">حذف</th>
                                <th class="font-weight-bold">ویرایش</th>
                                <th class="font-weight-bold">ایمیل</th>
                                <th class="font-weight-bold">نام</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $get = "SELECT * FROM users WHERE status<>'admin'";
                            $run = mysqli_query($con, $get);
                            while($row = mysqli_fetch_array($run)){
                                $id = $row['id'];
                                $name = $row['name'];
                                $email = $row['email'];
                            ?>
                            <tr>
                                <td><button type="button" class="btn btn-danger" onclick="del(<?php echo($id); ?>)">حذف</button></td>
                                <td><a class="btn btn-primary" href="?edit_user&id=<?php echo($id); ?>">ویرایش</a></td>
                                <td><?php echo($email); ?></td>
                                <td><?php echo($name); ?></td>
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