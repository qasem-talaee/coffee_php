<?php
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $insert = "INSERT INTO category (id, name) VALUES (NULL, '$name')";
    $run = mysqli_query($con, $insert);
    if($run){
        echo('<script>window.location.replace("index.php?cat");</script>');
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">اضافه کردن دسته بندی جدید</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?add_cat" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" />
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="اضافه کردن" />
                </form>
            </div>
        </div>
    </div>
</div>