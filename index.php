<?php
include 'includes/db.php';
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
    function set_order(id){
      var xmlhttp = new XMLHttpRequest();
      $.ajax({
        method : 'get',
        url : 'includes/set_order.php',
        data : {
          id : id,
        },
      success : function(data){
        if(data == "1"){
          Swal.fire({
            title: 'سفارش شما با موفقیت ثبت شد',
            icon: 'success',
          });
        }else{
          Swal.fire({
            icon: 'error',
            title: 'مشکلی پیش آمده است.لطفا دوباره تلاش کنید',
          });
        }
      }
    });
    }
  </script>

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
                <li><a href="index.php" class="active">منو</a></li>
                <li><a href="order.php">سفارشات من</a></li>
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
          <h2 class="white-text tm-handwriting-font tm-welcome-header"><img src="img/header-line.png" alt="Line" class="tm-header-line">&nbsp;منوی خوشمزه ما&nbsp;&nbsp;<img src="img/header-line.png" alt="Line" class="tm-header-line"></h2>
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
            <p class="tm-welcome-description">برای ثبت سفارشات پس از اضافه کردن سفارشات خود از منوی زیر لطفا به صفحه سفارشات من بروید.</p>
            <a href="order.php" class="tm-more-button margin-top-30">سفارشات من</a> 
          </div>
          <div class="col-lg-3 col-md-3 col-sm-4 tm-welcome-img-container">
            <div class="inline-block shadow-img">
              <img src="img/1.jpg" alt="Image" class="img-circle img-thumbnail">  
            </div>              
          </div>            
        </section> 

        <section class="tm-section row">
          <div class="col-lg-12 tm-section-header-container margin-bottom-30">
            <h2 class="tm-section-header gold-text tm-handwriting-font"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> منوی ما</h2>
            <div class="tm-hr-container"><hr class="tm-hr"></div>
          </div>
          <div>
            <div class="col-lg-12 col-md-12" id="menu">
              <div class="tm-position-relative margin-bottom-30">              
                <nav class="tm-side-menu">
                  <ul>
                <?php
                  $get_cat = "SELECT * FROM category";
                  $run_cat = mysqli_query($con, $get_cat);
                  while($row = mysqli_fetch_array($run_cat)){ 
                    $cat_id = $row['id'];
                    $cat_name = $row['name']; ?>

                    <li><a href="#<?php echo($cat_id); ?>"><?php echo($cat_name); ?></a></li>

                <?php
                  }
                ?>
                  </ul>              
                </nav>    
                <img src="img/vertical-menu-bg.png" alt="Menu bg" class="tm-side-menu-bg">
              </div>  
            </div>            
            <div class="tm-menu-product-content col-lg-12 col-md-12 text-right" style="margin-top: 25em;"> <!-- menu content -->
            <?php
              $get_cat = "SELECT * FROM category";
              $run_cat = mysqli_query($con, $get_cat);
              while($row = mysqli_fetch_array($run_cat)){ 
                $cat_id = $row['id'];
                $cat_name = $row['name']; ?>

                  <h2 id="<?php echo($cat_id); ?>" class="text-right"><img src="img/logo.png" alt="Logo" class="tm-site-logo"> <?php echo($cat_name); ?></h2>
                  
              <?php
                $get_pro = "SELECT * FROM product WHERE category_id=$cat_id";
                $run_pro = mysqli_query($con, $get_pro);
                while($row_pro = mysqli_fetch_array($run_pro)){
                  $pro_id = $row_pro['id'];
                  $pro_name = $row_pro['name'];
                  $pro_price = $row_pro['price'];
                  $pro_desc = $row_pro['description'];
                  $pro_img = $row_pro['img']; ?>

                  <div class="tm-product">
                    <img src="img/pro/<?php echo($pro_img); ?>" alt="<?php echo ($pro_name); ?>">
                    <div class="tm-product-text">
                      <h3 class="tm-product-title"><?php echo($pro_name); ?></h3>
                      <p class="tm-product-description"><?php echo($pro_desc); ?></p>
                    </div>
                    <div class="tm-product-price">
                      <button type="button" onclick="set_order(<?php echo($pro_id); ?>)" class="tm-product-price-link tm-handwriting-font"><?php echo($pro_price); ?> تومان</button>
                    </div>
                  </div>

              <?php
                }
              }
            ?>


            </div>
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