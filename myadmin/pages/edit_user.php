<?php
if($user_status != 'admin'){
    echo('<script>window.location.replace("index.php");</script>');
}
$id = $_GET['id'];
$get = "SELECT * FROM users WHERE id='$id'";
$run = mysqli_query($con, $get);
$row = mysqli_fetch_array($run);
$name = $row['name'];
$email = $row['email'];
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $update = "UPDATE users SET email='$email', name='$name', password='$pass' WHERE id='$id'";
    $run = mysqli_query($con, $update);
    if($run){
        echo('<script>window.location.replace("index.php?user");</script>');
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">ویرایش کردن کارمند</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?edit_user&id=<?php echo($id); ?>" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" value="<?php echo($name); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" name="email" class="form-control" value="<?php echo($email); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="pass">پسورد</label>
                        <input type="password" name="pass" class="form-control" required/>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="ویرایش کردن" />
                </form>
            </div>
        </div>
    </div>
</div>