<?php
namespace Verot\Upload;
include('includes/class.upload.php');
$id = $_GET ['id'];
$get = "SELECT * FROM product WHERE id='$id'";
$run = mysqli_query($con, $get);
$row = mysqli_fetch_array($run);
$gcat_id = $row['category_id'];
$name = $row['name'];
$price = $row['price'];
$description = $row['description'];
$img = $row['img'];
//
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $cat = $_POST['cat'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    //
    if($_FILES['img']['name'] == ""){
        $img_name = $img;
    }else{
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
    }
    $insert = "UPDATE product SET category_id='$cat', name='$name', price='$price', description='$description', img='$img_name' WHERE id='$id'";
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
                <p class="mb-lg-0 text-center">ویرایش کردن محصول </p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?edit_menu&id=<?php echo($id); ?>" class="form-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" style="direction:rtl;" value="<?php echo($name); ?>" />
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
                        <option value="<?php echo($cat_id); ?>" <?php if($cat_id == $gcat_id){echo('selected');} ?>><?php echo($cat_name); ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">قیمت به تومان</label>
                        <input type="text" name="price" class="form-control" value="<?php echo($price); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="name">توضیحات</label>
                        <textarea class="form-control text-right" style="direction:rtl;" rows="5" name="description"><?php echo($description); ?></textarea>
                    </div>
                    <div class="col-12">
                        <p>تصویر حال حاضر</p>
                        <img src="../img/pro/<?php echo($img); ?>" />
                    </div>
                    <p class="bg-danger text-black">اگر قصد عوض کردن عکس را ندارید فیلد زیر را خالی بگذارید</p>
                    <div class="form-group">
                        <label for="name">تصویر</label>
                        <input type="file" name="img" class="form-control file-upload-info" />
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="ویرایش کردن" />
                </form>
            </div>
        </div>
    </div>
</div>