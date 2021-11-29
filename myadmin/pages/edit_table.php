<?php
$id = $_GET['id'];
$get = "SELECT * FROM c_table WHERE id='$id'";
$run = mysqli_query($con, $get);
$row = mysqli_fetch_array($run);
$name = $row['name'];
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $update = "UPDATE c_table SET name='$name' WHERE id='$id'";
    $run = mysqli_query($con, $update);
    if($run){
        echo('<script>window.location.replace("index.php?table");</script>');
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">ویرایش کردن میز </p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?edit_table&id=<?php echo($id); ?>" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" value="<?php echo($name); ?>"/>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="ویرایش کردن" />
                </form>
            </div>
        </div>
    </div>
</div>