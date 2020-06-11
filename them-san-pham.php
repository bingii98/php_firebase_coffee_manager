<?php
require_once __DIR__ . '/model/User.php';
require_once __DIR__ . '/controller/FoodCtl.php';
require_once __DIR__ . '/controller/ListCtl.php';
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
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body id="page-top">
<div id="wrapper">
    <!-- Sidebar -->
    <?php include 'component/admin-slidebar.php' ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand topbar mb-4 static-top shadow navbar-manager -bg-darkblue">
                <!-- Topbar Navbar -->
                <?php include 'component/admin-header.php' ?>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow mb-4" style="max-width: 700px;margin: auto;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="txt-name">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="txt-name">
                                    </div>
                                    <div class="form-group">
                                        <label for="txt-price">Giá</label>
                                        <input type="text" class="form-control" id="txt-price">
                                    </div>
                                    <div class="form-group">
                                        <label for="txt-danhmuc">Danh mục</label>
                                        <select class="form-control" id="txt-list">
                                            <?php foreach ($arr_list as $item){ ?>
                                                <option value="<?php echo $item->getId() ?>"><?php echo $item->getName  () ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt-description">Mô tả</label>
                                        <textarea class="form-control" id="txt-description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Giảm giá</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="switch1">
                                            <label class="custom-control-label" for="switch1"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txt-range-sale">Phần trăm</label> <span class="font-weight-bold text-primary ml-2 valueSpan2" id="show-range-percent"></span>
                                        <input type="range" class="custom-range" id="txt-range-sale" name="points1">
                                    </div>
                                    <div class="form-group">
                                        <label for="txt-file">Hình ảnh</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="txt-file">
                                            <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary form-control" id="btn-add-product" type="button"><strong>Xác nhận</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow mb-4" style="max-width: 700px;margin: auto;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Xem trên màn hình</h6>
                            </div>
                            <div class="card-body">
                                <div class="card-list col-md-12" style="display: block;">
                                    <div class="card-image">
                                        <p class="sale">50%</p>
                                        <img src="https://firebasestorage.googleapis.com/v0/b/chbcoffee-4efec.appspot.com/o/white_vnese_coffee_9968c1184d7f4634a9bb9fce7b5ff313_master.webp?alt=media&amp;token=6d1b19a2-e1b2-4ccf-a64d-6c96ab3b8a25" alt="">
                                    </div>
                                    <div class="card-detail">
                                        <h3> BẠC SỈU</h3>
                                        <p class="price"> 14.500                            ₫ </p>
                                        <p class="sub-price"> 29.000                            ₫ </p>

                                        <button type="button" id="add_-M6ojDWDZRLq-TF-JevR" class="btnAddAction cart-action add-cart-btn" onclick="cartAction('add', '-M6ojDWDZRLq-TF-JevR')"><i class="fa fa-plus" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
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
<script>
    $("#btn-add-product").click(function () {
        const data = new FormData();
        const file = $('#txt-file')[0].files[0];
        const isSale = ($('#switch1').is(":checked")) ? true : false;
        data.append('file', file);
        data.append('name',$('#txt-name').val());
        data.append('list',$('#txt-list').val());
        data.append('description',$('#txt-description').val());
        data.append('isSale',isSale);
        data.append('price',$('#txt-price').val());
        data.append('rangeSale',$('#txt-range-sale').val());
        $.ajax({
            url : 'check-add-product.php',
            data : data,
            type: "POST",
            contentType: false,
            processData: false,
            success : function () {
            }
        })
    })

    $(document).ready(function() {
        const $valueSpan = $('#show-range-percent');
        const $value = $('#txt-range-sale');
        $valueSpan.html($value.val());
        $value.on('input change', () => {
            $valueSpan.html($value.val());
        });
    });
</script>
</body>

</html>
