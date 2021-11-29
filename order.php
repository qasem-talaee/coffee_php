<?php
include 'includes/db.php';
include 'includes/ip.php';
$get_info = "SELECT * FROM information";
$run_info = mysqli_query($con, $get_info);
$row_info = mysqli_fetch_array($run_info);
$shop_name = $row_info['name'];
$shop_desc = $row_info['description'];
$shop_add = $row_info['address'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo ($shop_name); ?></title>
<!-- 
Cafe House Template
http://www.templatemo.com/tm-466-cafe-house
-->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/templatemo-style.css" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />

  <script type="text/javascript" src="js/sweetalert.js"></script>
  <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script> 

  <script>
    function delete_order(id){
      var xmlhttp = new XMLHttpRequest();
      Swal.fire({
        title: 'آیا از این کار اطمینان دارید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله, پاک کن'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            method: 'get',
            url: 'includes/delete_order.php',
            data: {
              id: id,
            },
            success: function(data){
              if(data == "1"){
                Swal.fire(
                  'پاک شد',
                  'سبد سفارش شما به روز شد',
                  'success'
                )
                location.reload();
              }
            else{
              Swal.fire({
                icon: 'error',
                title: 'مشکلی پیش آمده است.لطفا دوباره تلاش کنید',
                });
              }
            }
          });
        }
      })
    }
    function change_order(id){
      var input_id = "count_" + id.toString();
      var x = document.getElementById(input_id).value;
      var xmlhttp = new XMLHttpRequest();
      $.ajax({
        method: 'get',
        url: 'includes/change_order.php',
        data: {
          id: id,
          new: x,
        },
        success: function(data){
          document.getElementById("tprice_" + id.toString()).innerHTML = data * x;
          $.ajax({
            method: 'get',
            url: 'includes/get_total.php',
            success: function(data){
              var out = "جمع کل    " + data + "   تومان"
              document.getElementById("total").innerHTML = out;
            }
          });
        }
      });
    }
    function set(){
      var xmlhttp = new XMLHttpRequest();
      var x = document.getElementById("table").value;
      if(table !== null){
        Swal.fire({
        title: 'آیا قصد دارید سفارش خود را ثبت کنید؟',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'بله, ثبت کن'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              method: 'get',
              url: 'includes/set_record_order.php',
              data:{
                table: x,
              },
              success: function(){
                location.reload();
              }
            });
          }
        });
      }
    }
  </script>

    <style>
    table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){background-color: #f2f2f2}
    </style>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <!-- Preloader -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
    <!-- End Preloader -->
    <div class="tm-top-header">
      <div class="container">
        <div class="row">
          <div class="tm-top-header-inner">
            <div class="tm-logo-container">
              <img src="img/logo.png" alt="Logo" class="tm-site-logo">
              <h1 class="tm-site-name tm-handwriting-font"><?php echo ($shop_name); ?></h1>
            </div>
            <div class="mobile-menu-icon">
              <i class="fa fa-bars"></i>
            </div>
            <nav class="tm-nav">
              <ul>
                <li><a href="index.php">منو</a></li>
                <li><a href="order.php" class="active">سفارشات من</a></li>
              </ul>
            </nav>   
          </div>           
        </div>    
      </div>
    </div>
    <section class="tm-welcome-section">
      <div class="container tm-position-relative">
        <div class="tm-lights-container">
          <img src="img/light.png" alt="Light" class="light light-1">
          <img src="img/light.png" alt="Light" class="light light-2">
          <img src="img/light.png" alt="Light" class="light light-3">  
        </div>        
        <div class="row tm-welcome-content">
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;سفارشات من&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
          <h2 class="gold-text tm-welcome-header-2"><?php echo($shop_name); ?></h2>
          <p class="gray-text tm-welcome-description"><?php echo($shop_desc); ?></p>
          <a href="order.php" class="tm-more-button tm-more-button-welcome">سفارشات من</a>      
        </div>
        <img src="img/table-set.png" alt="Table Set" class="tm-table-set img-responsive">  
      </div>      
    </section>
    <div class="tm-main-section light-gray-bg">
      <div class="container" id="main">
        
      <section class="tm-section row text-right" style="direction:rtl;">
          <div class="col-lg-9 col-md-9 col-sm-8">
            <h2 class="tm-section-header gold-text tm-handwriting-font">نحوه سفارش</h2>
            <p class="tm-welcome-description">شما در صفحه ثبت سفارش هستید.از طریق فرم زیر سفارش خود را ثبت کنید.</p>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/1.jpg" alt="Image" class="img-circle img-thumbnail">  
            </div>              
          </div>            
        </section> 

        <section class="tm-section row">
          <div class="col-lg-12 tm-section-header-container margin-bottom-30">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> سفارشات شما </h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>    
        </section>       
        <section class="tm-section row">
            <div class="col-12 text-right" style="direction:rtl;">
                <h3>
                    <label for="table">لطفا میز خود را انتخاب کنید</label>
                    <select name="table" id="table" width="100%" class="form-control" id="table">
                        <?php
                        $get_table = "SELECT * FROM c_table WHERE t_status=1";
                        $run_table = mysqli_query($con, $get_table);
                        $count_table = mysqli_num_rows($run_table);
                        if($count_table != 0){
                        while($row = mysqli_fetch_array($run_table)){
                            $id = $row['id'];
                            $name = $row['name']; ?>

                            <option style="font-family: Shabnam;" value="<?php echo($id); ?>"><?php echo($name); ?></option>

                    <?php    }}
                        ?>
                    </select>
                </h3>
                <div style="overflow-x:auto;" width="100%">
                    <table>
                        <thead>
                            <tr>
                                <th scope="">نام</th>
                                <th scope="">عکس</th>
                                <th scope="">تعداد</th>
                                <th scope="">قیمت واحد</th>
                                <th scope="">قیمت کل</th>
                                <th scope="">حذف</th>
                            </tr>
                        </thead>
                        <tbody>
                <?php
                $ip = get_ip();
                $get_order = "SELECT * FROM un_order WHERE ip='$ip'";
                $run_order = mysqli_query($con, $get_order);
                $sum = 0;
                while ($row = mysqli_fetch_array($run_order)) {
                    $pro_id = $row['product_id'];
                    $count = $row['count'];
                    $get_pro = "SELECT * FROM product WHERE id=$pro_id";
                    $run_pro = mysqli_query($con, $get_pro);
                    $row_pro = mysqli_fetch_array($run_pro);
                    $pro_name = $row_pro['name'];
                    $pro_img = $row_pro['img'];
                    $pro_price = $row_pro['price'];
                    $sum += ($count * $pro_price);
                    ?>

                    
                    <tr>
                        <td><?php echo ($pro_name); ?></td>
                        <td><img src="img/pro/<?php echo ($pro_img); ?>" /></td>
                        <td><input class="form-control" id="count_<?php echo ($pro_id); ?>" type="number" min="1" value="<?php echo($count); ?>" onchange="change_order(<?php echo ($pro_id); ?>)" /></td>
                        <td id="price_<?php echo ($pro_id); ?>"><?php echo ($pro_price); ?></td>
                        <td id="tprice_<?php echo ($pro_id); ?>"><?php echo ($count * $pro_price); ?></td>
                        <td><button type="button" onclick="delete_order(<?php echo ($pro_id); ?>)" class="btn btn-danger">&#215;</button></td>
                    </tr>
                    

            <?php    }
                ?>
                    
                    </tbody></table>
                    
                </div>
                <p id="total" class="text-center" style="font-size:2em;">جمع کل    <?php echo ($sum); ?>   تومان</p>
                <button type="button" onclick="set()" class="tm-more-button tm-more-button-welcome">ثبت سفارش</button>
            </div>  
        </section>
    </div> 
    </div>
    <footer>
      <div class="tm-black-bg">
        <div class="container">
          <div class="row margin-bottom-60">
      
            <div class="col-lg-5 col-md-5 tm-footer-div">
              <h3 class="tm-footer-div-title">آدرس ما</h3>
              <p class="margin-top-15"><?php echo($shop_add); ?></p>
            </div>
    
          </div>          
        </div>  
      </div>      
      <div>
        <div class="container">
          <div class="row tm-copyright" style="direction:rtl;"> 
           <p class="col-lg-12 small copyright-text text-center ">توسعه داده شده با <i class="fa fa-heart text-danger"></i> توسط <a class="btn btn-primary" target="_blank" href="http://qtle.ir">http://qtle.ir</a></>
         </div>  
       </div>
     </div>
   </footer> <!-- Footer content-->  
   <!-- JS -->     <!-- jQuery -->
   <script type="text/javascript" src="js/templatemo-script.js"></script>      <!-- Templatemo Script -->
   
   
 </body>
 </html>