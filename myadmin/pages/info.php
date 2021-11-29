<?php
$get = "SELECT * FROM information";
$run = mysqli_query($con, $get);
$row = mysqli_fetch_array($run);
$name = $row['name'];
$description = $row['description'];
$address = $row['address'];
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $update = "UPDATE information SET name='$name', description='$description', address='$address'";
    $run = mysqli_query($con, $update);
    if($run){
        echo('<script>window.location.replace("index.php?info");</script>');
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">ویرایش کردن اطلاعات سایت </p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?info" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" style="direction:rtl;" value="<?php echo($name); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="name">توضیحات</label>
                        <textarea name="description" class="form-control text-right" rows="5" style="direction:rtl;"><?php echo($description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">آدرس</label>
                        <textarea name="address" class="form-control text-right" rows="5" style="direction:rtl;"><?php echo($address); ?></textarea>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="ویرایش کردن" />
                </form>
            </div>
        </div>
    </div>
</div>