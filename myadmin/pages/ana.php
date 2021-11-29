<script src="js/canvasjs.min.js"></script>
<?php
$now_date = date('Y-m-d');
$day = date('Y-m-d', strtotime("first day of this month"));
$chart = array();
while($day <= $now_date){
    $get = "SELECT * FROM orders WHERE status='1' AND date='$day'";
    $run = mysqli_query($con, $get);
    $sum = 0;
    while($row = mysqli_fetch_array($run)){
        $pro_id = $row['product_id'];
        $count = $row['count'];
        $get_pro = "SELECT * FROM product WHERE id='$pro_id'";
        $run_pro = mysqli_query($con, $get_pro);
        $row_pro = mysqli_fetch_array($run_pro);
        $price = $row_pro['price'];
        $sum += ($count * $price);
    }
    array_push($chart, $sum);
    $day = date('Y-m-d',strtotime($day . "+1 days"));
}
?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	axisY:{
		includeZero: false
	},
	data: [{        
		type: "line",       
		dataPoints: [
            <?php
            foreach($chart as $y){
                echo("{y: $y},");
            }
            ?>
		]
	}]
});
chart.render();

}
</script>
<div style="direction:rtl;">
    <div class="row purchace-popup text-center">
        <div class="col-12 stretch-card grid-margin text-center">
            <div class="card card-secondary text-center">
                <span class="card-body d-lg-flex align-items-center text-center">
                <p class="mb-lg-0 text-center">آنالیز اطلاعات کافه</p>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-sm-flex align-items-baseline report-summary-header">
                            <h5 class="font-weight-semibold">گزارش فروش</h5> 
                        </div>
                    </div>
                </div>
                <?php
                $get_all = "SELECT * FROM orders WHERE status='1'";
                $run_all = mysqli_query($con, $get_all);
                $sum = 0;
                while($row_all = mysqli_fetch_array($run_all)){
                    $count = $row_all['count'];
                    $pro_id = $row_all['product_id'];
                    $get_pro = "SELECT * from product WHERE id='$pro_id'";
                    $run_pro = mysqli_query($con, $get_pro);
                    $row_pro = mysqli_fetch_array($run_pro);
                    $price = $row_pro['price'];
                    $sum += ($count * $price);
                }
                ?>
                <div class="row report-inner-cards-wrapper">
                    <div class=" col-md -6 col-xl report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">فروش کل</span>
                            <h4>تومان <?php echo($sum); ?></h4>
                        </div>
                        <div class="inner-card-icon bg-success">
                            <i class="icon-rocket"></i>
                        </div>
                    </div>
                    <?php
                    $date = date('Y-m-d');
                    $get_all = "SELECT * FROM orders WHERE status='1' AND date='$date'";
                    $run_all = mysqli_query($con, $get_all);
                    $sum = 0;
                    while($row_all = mysqli_fetch_array($run_all)){
                        $count = $row_all['count'];
                        $pro_id = $row_all['product_id'];
                        $get_pro = "SELECT * from product WHERE id='$pro_id'";
                        $run_pro = mysqli_query($con, $get_pro);
                        $row_pro = mysqli_fetch_array($run_pro);
                        $price = $row_pro['price'];
                        $sum += ($count * $price);
                    }
                    ?>
                    <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">فروش امروز</span>
                            <h4>تومان <?php echo($sum); ?></h4>
                        </div>
                        <div class="inner-card-icon bg-danger">
                            <i class="icon-briefcase"></i>
                        </div>
                    </div>
                    <?php
                    $date = date('Y-m');
                    $get_all = "SELECT * FROM orders WHERE status='1' AND date regexp '$date'";
                    $run_all = mysqli_query($con, $get_all);
                    $sum = 0;
                    while($row_all = mysqli_fetch_array($run_all)){
                        $count = $row_all['count'];
                        $pro_id = $row_all['product_id'];
                        $get_pro = "SELECT * from product WHERE id='$pro_id'";
                        $run_pro = mysqli_query($con, $get_pro);
                        $row_pro = mysqli_fetch_array($run_pro);
                        $price = $row_pro['price'];
                        $sum += ($count * $price);
                    }
                    ?>
                    <div class="col-md-6 col-xl report-inner-card">
                        <div class="inner-card-text">
                            <span class="report-title">فروش این ماه</span>
                            <h4>تومان <?php echo($sum); ?></h4>
                        </div>
                        <div class="inner-card-icon bg-warning">
                            <i class="icon-globe-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">نمودار فروش در این ماه</h4>
                <div class="ct-chart ct-perfect-fourth" id="chartContainer" ></div>
            </div>
        </div>
    </div>
</div>

