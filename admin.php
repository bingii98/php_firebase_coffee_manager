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
//Statistics of the week
$saDateWeek = $d = DateTime::createFromFormat('d-m-Y H:i:s', '' . date("d-m-yy", strtotime('-11 days')) . ' 00:00:00', new DateTimeZone('UTC'));
$stDateWeek = $d = DateTime::createFromFormat('d-m-Y H:i:s', '' . date('d-m-yy') . ' 00:00:00', new DateTimeZone('UTC'));
$resultWeek = $orderCtl->get_range_date($saDateMonth->getTimestamp(), $stDateMonth->getTimestamp());

$m1 = $orderCtl->count_sales_week($resultWeek, 11);
$m2 = $orderCtl->count_sales_week($resultWeek, 10);
$m3 = $orderCtl->count_sales_week($resultWeek, 9);
$m4 = $orderCtl->count_sales_week($resultWeek, 8);
$m5 = $orderCtl->count_sales_week($resultWeek, 7);
$m6 = $orderCtl->count_sales_week($resultWeek, 6);
$m7 = $orderCtl->count_sales_week($resultWeek, 5);
$m8 = $orderCtl->count_sales_week($resultWeek, 4);
$m9 = $orderCtl->count_sales_week($resultWeek, 3);
$m10 = $orderCtl->count_sales_week($resultWeek, 2);
$m11 = $orderCtl->count_sales_week($resultWeek, 1);
$m12 = $orderCtl->count_sales_week($resultWeek, 0);

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
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>
<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'component/admin-slidebar.php' ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
                <!-- Topbar Navbar -->
                <?php include 'component/admin-header.php' ?>
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
                                <h6 class="m-0 font-weight-bold text-primary">Tổng quan thu nhập 12 ngày qua
                                    <qua></qua>
                                </h6>
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
                                <h6 class="m-0 font-weight-bold text-primary">Top 4 bán chạy (<?php echo date('yy') ?>
                                    )</h6>
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
            </div>
        </div>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="public/vendor/chart.js/Chart.min.js"></script>
<script src="public/js/header.js"></script>

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
            labels: [<?php echo '"' . date("d-m-yy", strtotime('-11 days')) . '","'. date("d-m-yy", strtotime('-10 days')) . '","' . date("d-m-yy", strtotime('-9 days')) . '","' . date("d-m-yy", strtotime('-8 days')) . '","' . date("d-m-yy", strtotime('-7 days')) . '","' . date("d-m-yy", strtotime('-6 days')) . '","' . date("d-m-yy", strtotime('-5 days')) . '","' . date("d-m-yy", strtotime('-4 days')) . '","' . date("d-m-yy", strtotime('-3 days')) . '","' . date("d-m-yy", strtotime('-2 days')) . '","' . date("d-m-yy", strtotime('-1 days')) . '","' . date("d-m-yy", strtotime('-0 days')) . '"' ?>],
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
