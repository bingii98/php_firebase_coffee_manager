<?php
include_once __DIR__ . '/model/User.php';
include_once __DIR__ . '/controller/FoodCtl.php';
include_once __DIR__ . '/controller/ListCtl.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php');
$foodCtl = new FoodCtl();
$listCtl = new ListCtl();
$arr_list = $listCtl->getAll();
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
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="txt-name" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="txt-name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt-danhmuc" class="col-sm-2 col-form-label">Danh mục</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="txt-list">
                                        <?php foreach ($arr_list as $item){ ?>
                                            <option value="<?php echo $item->getId() ?>"><?php echo $item->getName() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt-description" class="col-sm-2 col-form-label">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="txt-description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="custom-control custom-switch col-sm-10 offset-sm-2"
                                     style="padding-left: 3.25rem;">
                                    <input type="checkbox" class="custom-control-input" id="switch1">
                                    <label class="custom-control-label" for="switch1">Giảm giá</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt-range-sale" class="col-sm-2 col-form-label">Phần trăm</label>
                                <div class="col-sm-10">
                                    <input type="range" class="custom-range" id="txt-range-sale" name="points1">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt-file" class="col-sm-2 col-form-label">Hình ảnh</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="txt-file">
                                        <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txt-file" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button class="btn btn-primary form-control"><strong>Xác nhận</strong></button>
                                </div>
                            </div>
                        </form>
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
<!-- End of Page Wrapper -->

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
<script src="public/vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>

</html>
