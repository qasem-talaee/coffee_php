<?php
namespace Verot\Upload;
include('includes/class.upload.php');
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    //
    $img_name = time();
    $foo = new upload($_FILES['img']);
    $foo->file_new_name_body = $img_name;
    $foo->image_resize = true;
    $foo->image_convert = 'jpg';
    $foo->image_x = 136;
    $foo->image_y = 136;
    $foo->process('../img/pro/');
    if ($foo->processed) {
        $foo->clean();
    }
    $img_name .= '.jpg';
    $insert = "INSERT INTO product (id, category_id, name, price, description, img) VALUES (NULL, '$cat', '$name', '$price', '$description', '$img_name')";
    $run = mysqli_query($con, $insert);
    if($run){
        echo('<script>window.location.replace("index.php?menu");</script>');
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">اضافه کردن محصول جدید</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?add_menu" class="form-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" style="direction:rtl;" />
                    </div>
                    <div class="form-group">
                        <label for="name">دسته بندی</label>
                        <select name="cat" class="form-control text-right">
                        <?php
                        $get_cat = "SELECT * FROM category";
                        $run_cat = mysqli_query($con, $get_cat);
                        while($row_cat = mysqli_fetch_array($run_cat)){
                            $cat_id = $row_cat['id'];
                            $cat_name = $row_cat['name'];
                        ?>
                        <option value="<?php echo($cat_id); ?>"><?php echo($cat_name); ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">قیمت به تومان</label>
                        <input type="text" name="price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="name">توضیحات</label>
                        <textarea class="form-control text-right" style="direction:rtl;" rows="5" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">تصویر</label>
                        <input type="file" name="img" class="form-control file-upload-info" />
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="اضافه کردن" />
                </form>
            </div>
        </div>
    </div>
</div>