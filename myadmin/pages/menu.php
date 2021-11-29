<?php
$per_page = 20;
$get_all = "SELECT * FROM product";
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
$get = "SELECT * FROM product ORDER BY id DESC LIMIT $start, $per_page";
$run = mysqli_query($con, $get);
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
              url: 'includes/del_menu.php',
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
                <p class="mb-lg-0 text-center">لیست محصولات</p>
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
                <a class="mb-lg-0 text-center btn btn-primary" href="?add_menu">اضافه کردن محصول جدید</a>
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
                    <h4 class="card-title mb-sm-0">محصولات</h4>
                </div>
                <div class="table-responsive border rounded p-1">
                    <table class="table text-right">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">حذف</th>
                                <th class="font-weight-bold">ویرایش</th>
                                <th class="font-weight-bold">قیمت</th>
                                <th class="font-weight-bold">دسته بندی</th>
                                <th class="font-weight-bold">نام</th>
                                <th class="font-weight-bold">تصویر</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($run)){
                                $id = $row['id'];
                                $img = $row['img'];
                                $name = $row['name'];
                                $price = $row['price'];
                                $cat_id = $row['category_id'];
                                //
                                $get_cat = "SELECT * FROM category WHERE id='$cat_id'";
                                $run_cat = mysqli_query($con, $get_cat);
                                $row_cat = mysqli_fetch_array($run_cat);
                                $cat_name = $row_cat['name'];
                                ?>
                            <tr>
                                <td><button type="button" class="btn btn-danger" onclick="del(<?php echo($id); ?>)">حذف</button></td>
                                <td><a class="btn btn-primary" href="?edit_menu&id=<?php echo($id); ?>">ویرایش</a></td>
                                <td><?php echo($price); ?></td>
                                <td><?php echo($cat_name); ?></td>
                                <td><?php echo($name); ?></td>
                                <td><img src="../img/pro/<?php echo($img); ?>" /></td>
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
                            <li class="page-item <?php if($page == $i){echo('active');} ?>"><a href="?menu&page=<?php echo($i); ?>" class="page-link"><?php echo($i); ?></a></li>
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