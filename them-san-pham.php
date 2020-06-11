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
                    <div class="col-md-6">
                        <div class="card shadow mb-4" style="max-width: 700px;margin: auto;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h6>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label" for="txt-name">Tên sản phẩm</label>
                                        <input type="text" class="form-input form-control" id="txt-name">
                                        <label class="form-error" id="error-name"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="txt-price">Giá</label>
                                        <input type="text" class="form-input form-control" id="txt-price">
                                        <label class="form-error" id="error-price"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="txt-danhmuc">Danh mục</label>
                                        <select class="form-control form-input" id="txt-list">
                                            <?php foreach ($arr_list as $item) { ?>
                                                <option value="<?php echo $item->getId() ?>"><?php echo $item->getName() ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="txt-description">Mô tả</label>
                                        <textarea class="form-control form-input" id="txt-description"
                                                  rows="3"></textarea>
                                        <label class="form-error" id="error-description"></label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Giảm giá</label>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input form-input" id="switch1">
                                            <label class="custom-control-label" for="switch1"></label>
                                            <label class="form-error" id="error-issale"></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="txt-range-sale">Phần trăm</label> <span
                                                class="font-weight-bold text-primary ml-2 valueSpan2"
                                                id="show-range-percent"></span>
                                        <input type="range" class="custom-range" id="txt-range-sale" name="points1">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="txt-file">Hình ảnh</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input form-input" id="txt-file">
                                            <label class="custom-file-label form-input" for="customFile" id="lb-txt-file"></label>
                                            <label class="form-error" id="error-image"></label>
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
                    <div class="col-md-6">
                        <div class="card shadow mb-4" style="max-width: 700px;margin: auto;">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Xem trên màn hình</h6>
                            </div>
                            <div class="card-body">
                                <div class="card-list col-md-12" style="display: block;">
                                    <div class="card-image">
                                        <p id="sale-preview" class="sale">_</p>
                                        <img id="img-preview" src="https://www.centrum2play.nl/wp-content/plugins/lifterlms/assets/images/placeholder.png">
                                    </div>
                                    <div class="card-detail">
                                        <h3 id="name-preview"_></h3>
                                        <p id="price-preview" class="price">_</p>
                                        <p id="price-sale-preview" class="sub-price">_</p>
                                        <button type="button" class="btnAddAction cart-action add-cart-btn"><i
                                                class="fa fa-plus" aria-hidden="true"></i>
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
        data.append('name', $('#txt-name').val());
        data.append('list', $('#txt-list').val());
        data.append('description', $('#txt-description').val());
        data.append('isSale', isSale);
        data.append('price', $('#txt-price').val());
        data.append('rangeSale', $('#txt-range-sale').val());
        $.ajax({
            url: 'check-add-product.php',
            data: data,
            type: "POST",
            contentType: false,
            processData: false,
            success: function () {
            }
        })
    })

    $(document).ready(function () {
        const $valueSpan = $('#show-range-percent')
        const $value = $('#txt-range-sale')
        const $pr_name = $('#txt-name')
        const $pr_price = $('#txt-price')
        const $pr_isSale = $('#switch1')
        const $pr_sale = $('#txt-range-sale')
        const $pr_image = $('#txt-file')
        $valueSpan.html($value.val())
        $value.on('input change', () => {
            $valueSpan.html($value.val());
        })
        $pr_name.on('input change', () => {
            $('#name-preview').html($pr_name.val());
        })
        $pr_price.on('input change', () => {
            changePrice()
        })
        $pr_sale.on('input change', () => {
            changePrice()
        })
        $pr_isSale.on('input change', () => {
            changePrice()
        })
        $pr_image.change(function() {
            readURL(this)
        })

        function changePrice() {
            if($('#switch1').is(":checked")){
                if($pr_sale.val() != 0 && $pr_price.val() != ''){
                    $('#price-sale-preview').html(formatNumber($pr_price.val()) + "  ₫")
                    $('#price-preview').html(formatNumber($pr_price.val() - $pr_price.val()/100*$pr_sale.val()) + "  ₫")
                    $('#sale-preview').show()
                    $('#sale-preview').html($pr_sale.val() + "%")
                }else{
                    $('#price-preview').html(formatNumber($pr_price.val()) + "  ₫")
                    $('#price-sale-preview').html('')
                    $('#sale-preview').hide()
                }
            }else{
                $('#price-preview').html(formatNumber($pr_price.val()) + "  ₫")
                $('#price-sale-preview').html('')
                $('#sale-preview').hide()
            }
        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $('#txt-file')[0].files[0]['name'];
            reader.onload = function(e) {
                $('#img-preview').attr('src', e.target.result);
                $('#lb-txt-file').text('Đã chọn');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function formatNumber(n) {
        n = Number(n)
        return n.toFixed(0).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        });
    }


</script>
</body>

</html>
