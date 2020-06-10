<?php
include_once __DIR__ . '/model/User.php';
include_once __DIR__ . '/controller/OrderCtl.php';
include_once __DIR__ . '/controller/FoodCtl.php';
include_once __DIR__ . '/controller/TableCtl.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php');

$orderCtl = new OrderCtl();
$tableCtl = new TableCtl();
$foodCtl = new FoodCtl();
//Get table status
$arr_table = $tableCtl->get_is_food();
$arr_food_id = array();
$count_active = 0;
foreach ($arr_table as $key => $item) {
    if ($item->countOrder() > 0) {
        $count_active++;
    }
}
$percent_active = round($count_active / count($arr_table) * 100, 2);

//Statistics of the month
$saDateMonth = $d = DateTime::createFromFormat('d-m-Y H:i:s', '01-' . date("m-yy") . ' 00:00:00', new DateTimeZone('UTC'));
$stDateMonth = $d = DateTime::createFromFormat('d-m-Y H:i:s', '' . date("t-m-yy") . ' 00:00:00', new DateTimeZone('UTC'));
$resultMonth = $orderCtl->get_range_date($saDateMonth->getTimestamp(), $stDateMonth->getTimestamp());
$count_month = 0;
foreach ($resultMonth as $order) {
    foreach ($order->getOrderDetails() as $orderD) {
        $count_month += $orderD->getNum() * $orderD->getPrice();
    }
}
//Statistics of the year
$saDateYear = $d = DateTime::createFromFormat('d-m-Y H:i:s', '01-01-' . date("yy") . ' 00:00:00', new DateTimeZone('UTC'));
$stDateYear = $d = DateTime::createFromFormat('d-m-Y H:i:s', '31-12-' . date("yy") . ' 00:00:00', new DateTimeZone('UTC'));
$resultYear = $orderCtl->get_range_date($saDateMonth->getTimestamp(), $stDateMonth->getTimestamp());
$count_year = 0;
foreach ($resultYear as $order) {
    foreach ($order->getOrderDetails() as $orderD) {
        $count_year += $orderD->getNum() * $orderD->getPrice();
        for ($i = 0; $i < $orderD->getNum(); $i++) {
            array_push($arr_food_id, $orderD->getFood());
        }
    }
}

//Statistics per month
$m1 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 1) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m1 = 0;
$m2 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 2) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m2 = 0;
$m3 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 3) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m3 = 0;
$m4 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 4) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m4 = 0;
$m5 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 5) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m5 = 0;
$m6 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 6) return $carry + $value->revenueCount();
    return $carry;
});
if ($m6 == null) $m6 = 0;
$m7 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 7) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m7 = 0;
$m8 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 8) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m8 = 0;
$m9 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 9) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m9 = 0;
$m10 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 10) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m10 = 0;
$m11 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 11) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m11 = 0;
$m12 = array_reduce($resultYear, function ($carry, $value) {
    if (date('m', $value->getDate()) == 12) return $carry + $value->revenueCount();
    return $carry;
});
if ($m1 == null) $m12 = 0;

//Handle food
$arr_food_id = array_count_values($arr_food_id);
arsort($arr_food_id);
$arr_food_id = array_slice($arr_food_id, 0, 5);
$f1 = $foodCtl->get(array_keys(array_slice($arr_food_id, 0, 1))[0]);
$f2 = $foodCtl->get(array_keys(array_slice($arr_food_id, 1, 1))[0]);
$f3 = $foodCtl->get(array_keys(array_slice($arr_food_id, 2, 1))[0]);
$f4 = $foodCtl->get(array_keys(array_slice($arr_food_id, 3, 1))[0]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CHB Coffee - Administrator </title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'component/admin-slidebar.php' ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                               aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Topbar Navbar -->
                <?php include 'component/admin-header.php' ?>
            </nav>
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800" style="font-size: 20px;font-weight: 600;">Thống kê</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Doanh thu
                                            (Tháng <?php echo date('m') ?>)
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_month, 0, "", ".") ?>
                                            ₫
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh thu
                                            (<?php echo date('yy') ?>)
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($count_year, 0, "", ".") ?>
                                            ₫
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Bàn đang
                                            hoạt động (<?php echo $count_active . '/' . count($arr_table) ?>)
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $percent_active ?>
                                                    %
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                         style="width: <?php echo $percent_active ?>%"
                                                         aria-valuenow="<?php echo $percent_active ?>" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Area Chart -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Tổng quan thu nhập (<?php echo date('yy') ?>)</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                         aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-area">
                                    <canvas id="myAreaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pie Chart -->
                    <div class="col-xl-12 col-lg-12">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Top 4 bán chạy (<?php echo date('yy') ?>)</h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                         aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-header">Dropdown Header:</div>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                      <i class="fas fa-circle text-primary"></i> <?php echo $f1->getName() ?>
                                    </span>
                                    <span class="mr-2">
                                      <i class="fas fa-circle text-success"></i> <?php echo $f2->getName() ?>
                                    </span>
                                    <span class="mr-2">
                                      <i class="fas fa-circle text-info"></i> <?php echo $f3->getName() ?>
                                    </span>
                                    <span class="mr-2">
                                      <i class="fas fa-circle text-default"></i> <?php echo $f4->getName() ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-6 mb-4">

                        <!-- Project Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Projects</h6>
                            </div>
                            <div class="card-body">
                                <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                         aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Customer Database <span
                                            class="float-right">60%</span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span>
                                </h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                         aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Account Setup <span
                                            class="float-right">Complete!</span></h4>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Color System -->
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-primary text-white shadow">
                                    <div class="card-body">
                                        Primary
                                        <div class="text-white-50 small">#4e73df</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-success text-white shadow">
                                    <div class="card-body">
                                        Success
                                        <div class="text-white-50 small">#1cc88a</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-info text-white shadow">
                                    <div class="card-body">
                                        Info
                                        <div class="text-white-50 small">#36b9cc</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-warning text-white shadow">
                                    <div class="card-body">
                                        Warning
                                        <div class="text-white-50 small">#f6c23e</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-danger text-white shadow">
                                    <div class="card-body">
                                        Danger
                                        <div class="text-white-50 small">#e74a3b</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-4">
                                <div class="card bg-secondary text-white shadow">
                                    <div class="card-body">
                                        Secondary
                                        <div class="text-white-50 small">#858796</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 mb-4">

                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Illustrations</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                         src="img/undraw_posting_photo.svg" alt="">
                                </div>
                                <p>Add some quality, svg illustrations to your project courtesy of <a target="_blank"
                                                                                                      rel="nofollow"
                                                                                                      href="https://undraw.co/">unDraw</a>,
                                    a constantly updated collection of beautiful svg images that you can use
                                    completely
                                    free and without attribution!</p>
                                <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on
                                    unDraw &rarr;</a>
                            </div>
                        </div>

                        <!-- Approach -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                            </div>
                            <div class="card-body">
                                <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce
                                    CSS
                                    bloat and poor page performance. Custom CSS classes are used to create custom
                                    components and custom utility classes.</p>
                                <p class="mb-0">Before working with this theme, you should become familiar with the
                                    Bootstrap framework, especially the utility classes.</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2019</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="public/vendor/chart.js/Chart.min.js"></script>

<!-- Pie Chart scripts -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [<?php echo "'" . $f1->getName() . "','" . $f2->getName() . "','" . $f3->getName() . "','" . $f4->getName() . "'" ?>],
            datasets: [{
                data: [<?php echo array_values(array_slice($arr_food_id, 0, 1))[0] . ',' . array_values(array_slice($arr_food_id, 1, 1))[0] . ',' . array_values(array_slice($arr_food_id, 2, 1))[0] . ',' . array_values(array_slice($arr_food_id, 3, 1))[0]  ?>],
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    });

</script>
<!-- Area Char  scripts -->
<script>
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
        number = (number + '').replace(',', '').replace(' ', '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["T1", "T 2", "T 3", "T 4", "T 5", "T 6", "T 7", "T 8", "T 9", "T 10", "T 11", "T 12"],
            datasets: [{
                label: "Doanh thu",
                lineTension: 0.3,
                backgroundColor: "rgba(78, 115, 223, 0.05)",
                borderColor: "rgba(78, 115, 223, 1)",
                pointRadius: 3,
                pointBackgroundColor: "rgba(78, 115, 223, 1)",
                pointBorderColor: "rgba(78, 115, 223, 1)",
                pointHoverRadius: 3,
                pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                pointHitRadius: 10,
                pointBorderWidth: 2,
                data: [<?php echo $m1 . ',' . $m2 . ',' . $m3 . ',' . $m4 . ',' . $m5 . ',' . $m6 . ',' . $m7 . ',' . $m8 . ',' . $m9 . ',' . $m10 . ',' . $m11 . ',' . $m12 ?>],
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 25,
                    top: 25,
                    bottom: 0
                }
            },
            scales: {
                xAxes: [{
                    time: {
                        unit: 'date'
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + ' ₫';
                        }
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2]
                    }
                }],
            },
            legend: {
                display: false
            },
            tooltips: {
                backgroundColor: "rgb(255,255,255)",
                bodyFontColor: "#858796",
                titleMarginBottom: 10,
                titleFontColor: '#6e707e',
                titleFontSize: 14,
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                intersect: false,
                mode: 'index',
                caretPadding: 10,
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' ₫';
                    }
                }
            }
        }
    });

</script>
</body>

</html>
