<?php
require_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php');
if (!$_SESSION['_userSignedIn']->getIsAdmin()) {
    header('Location: 403.html');
}
$dateMY = (isset($_GET['date']) ? $_GET['date'] : date("d-m-Y"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CHB Coffee - Sản phẩm</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet prefetch" href="public/asset/css/datepicker.css">
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <style>
        .datepicker-dropdown {
            width: 274px;
            background: var(--bg-dark-card);
        }
    </style>
</head>
<body id="page-top">
<div class="wrapper">
</div>
<div id="loaded">
    <div class="loading">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="loading-overlay"></div>
</div>
<div id="wrapper">
    <?php include 'component/admin-slidebar.php' ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'component/admin-header.php' ?>
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="d-sm-flex align-items-center justify-content-between" style="margin: 20px 20px 10px;">
                        <h1 class="h3 mb-0 text-gray-800" style="font-size: 20px;font-weight: 600;">Danh sách hoá đơn</h1>
                        <div id="datepicker" class="d-none d-sm-inline-block date" data-date-format="mm-yyyy">
                            <div class="d-flex">
                                <input class="form-control form-input mr-1" readonly="" type="text" id="date-pick"
                                       style="background: #00000050;height: 35px;">
                                <button class="form-control btn btn-sm btn-primary shadow-sm" id="btn-filter-al">Tìm
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                   style="font-size: 14px;">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>Ngày</th>
                                    <th>Chi tiết</th>
                                    <th>Tổng giá</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <?php
                                    if(!isset($_GET['date'])){
                                        echo '<small><p><i>Đang hiển thị theo danh sách tổng</i></p></small>';
                                    }else{
                                        echo '<small><p><i>Đang hiển thị theo danh sách theo ngày '.$_GET['date'].'</i></p></small>';
                                    }
                                ?>
                                <tbody id="data-order-table">
                                <tr>
                                    <td colspan="6" style="text-align: center">
                                        <p id="loading-svg" style="width: 100%; text-align: center">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                                <rect x="0" y="7.337" width="4" height="15.326" fill="#333" opacity="0.2">
                                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>
                                                </rect>
                                                <rect x="8" y="9.837" width="4" height="10.326" fill="#333" opacity="0.2">
                                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>
                                                </rect>
                                                <rect x="16" y="7.663" width="4" height="14.674" fill="#333" opacity="0.2">
                                                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>
                                                </rect>
                                            </svg>
                                        </p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="orderDetailModal" tabindex="-1" role="dialog" aria-labelledby="orderDetailModal"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">Chi tiết hoá đơn</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body" id="model-detail-content">

                </div>
            </div>
        </div>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<input type="hidden" value="<?php echo (!isset($_GET['date'])) ? '' : $_GET['date']?>" id="param_date">
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="public/js/sb-admin-2.min.js"></script>
<script src="public/asset/js/bootstrap.min.js"></script>
<script src="public/asset/js/bootstrap-datepicker.js"></script>
<script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="public/js/header.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-database.js"></script>
<script src="public/js/ajax/firebase-reload-data-event.js"></script>
<script src="public/js/regex.js"></script>
<script src="public/js/ajax/order-list.js"></script>
<script>
    /* DATE PICKED */
    $(function () {
        $("#datepicker").datepicker({
            format: "dd-mm-yyyy",
            endDate: new Date(new Date().setDate(new Date().getDate()))
        })
    });

    $(document).on('click', '#btn-filter-al', function () {
        window.location.href = "admin-hoa-don.php?date=" + $('#date-pick').val();
    })

    $(document).ready(function () {
        $('#loaded').hide();
        $("#date-pick").val("<?php echo $dateMY ?>");
    })
</script>
</body>

</html>
