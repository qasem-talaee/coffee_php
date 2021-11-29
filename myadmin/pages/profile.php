<?php
$s_email = $_SESSION['email'];
$get = "SELECT * FROM users WHERE email='$s_email'";
$run = mysqli_query($con, $get);
$row = mysqli_fetch_array($run);
$name = $row['name'];
$pass = $row['password'];
$flag = 1;
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    if($_POST['old_pass'] == ''){
        $password = $pass;
    }else{
        if(md5($_POST['old_pass']) == $pass){
            if($_POST['new_pass'] == $_POST['new_pass_again']){
                $password = md5($_POST['new_pass']);
            }else{
                $flag = 0;
            }
        }else{
            $flag = 0;
        }
    }
    if($flag == 1){
        $update = "UPDATE users SET name='$name', email='$email', password='$password' WHERE email = '$s_email'";
        $run = mysqli_query($con, $update);
        if($run){
            session_destroy();
            echo('<script>window.location.replace("index.php?profile");</script>');
        }
    }
}
?>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">ویرایش کردن اطلاعات شخصی شما </p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-right">
                <form method="post" action="?profile" class="form-sample">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" name="name" class="form-control text-right" style="direction:rtl;" value="<?php echo($name); ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">ایمیل</label>
                        <input type="email" name="email" class="form-control text-right" style="direction:rtl;" value="<?php echo($email); ?>"/>
                    </div>
                    <p class="bg-danger text-dark">اکر قصد ندارید پسورد خود را عوض کنید فیلدهای زیر را خالی بگذارید</p>
                    <div class="form-group">
                        <label for="email">پسورد</label>
                        <input type="password" name="old_pass" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email">پسورد جدید</label>
                        <input type="password" name="new_pass" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label for="email">تکرار پسورد جدید</label>
                        <input type="password" name="new_pass_again" class="form-control" />
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="ویرایش کردن" />
                </form>
            </div>
        </div>
    </div>
</div>