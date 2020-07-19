<?php
include 'check-admin.php';
require_once __DIR__ . '/controller/ListCtl.php';
$listCtl = new ListCtl();
?>
<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CHB Coffee - Sản phẩm</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'component/admin-slidebar.php' ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Topbar Navbar -->
            <?php include 'component/admin-header.php' ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card shadow mb-4" style="max-width: 700px;margin: auto;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Thêm bàn</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label" for="txt-name">Tên bàn</label>
                                        <input type="text" class="form-input form-control" id="txt-name">
                                        <label class="form-error" id="error-name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Hoạt động</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input form-input" id="switch1">
                                            <label class="custom-control-label" for="switch1"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" id="btn-add-product" type="button">
                                            <strong>Xác nhận</strong></button>
                                    </div>
                                </form>
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
<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-storage.js"></script>
<script src="public/js/header.js"></script>
<script src="public/js/regex.js"></script>
<script src="public/js/ajax/add-table.js"></script>
</body>

</html>
