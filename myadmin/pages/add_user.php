<?php
if($user_status != 'admin'){
    echo('<script>window.location.replace("index.php");</script>');
}
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = md5($_POST['pass']);
    $insert = "INSERT INTO users (id, status, email, name, password) VALUES (NULL, 'User', '$email', '$name', '$pass')";
    $run = mysqli_query($con, $insert);
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
                <p class="mb-lg-0 text-center">اضافه کردن کارمند جدید</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?add_user" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" />
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" name="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="pass">پسورد</label>
                        <input type="password" name="pass" class="form-control" />
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="اضافه کردن" />
                </form>
            </div>
        </div>
    </div>
</div>