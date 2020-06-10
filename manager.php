<?php
include_once __DIR__ . '/model/User.php';
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['_userSignedIn'])) header('Location: login.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CHB - Coffee Manager</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://bingii901.com/images/icons/favicon.ico">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/notification.css">
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="wrapper">
</div>
<?php include 'component/header.php' ?>
<script> document.getElementById('header-table').classList.add("active"); </script>
<section style="margin-top: 70px;">
    <div class="row manager-desk">
        <div id="loaded">
            <div class="loading">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="loading-overlay"></div>
        </div>
        <div class="slidebar col-3">
            <ul class="list-desk">
                <li class="header">Loại bàn <i class="fa fa-cubes" aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php"><p>Tất cả</p><i class="fa fa-caret-right"
                                                                                 aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php?is_empty=true"><p>Bàn trống</p><i
                            class="fa fa-caret-right" aria-hidden="true"></i></li>
                <li class="item redirect" dataHref="manager.php?is_empty=false"><p>Bàn có người</p><i
                            class="fa fa-caret-right" aria-hidden="true"></i></li>
            </ul>
        </div>
        <div class="content col-8">
            <ul class="card-box-desk" id="loaded-data-table">

            </ul>
        </div>
    </div>
</section>
<!-- Modal -->
<div class="modal fade" id="table-detail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" style="margin-top: 70px;">
    <div class="modal-dialog" role="document" id="print-order">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">Thông
                    tin thanh toán</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cart-item" style="margin: 0;box-shadow: none;padding: 0 21px;"></div>
            </div>
        </div>
    </div>
</div>
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src="public/asset/js/bootstrap.bundle.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-database.js"></script>
<script src="public/js/firebase-reload-data-event.js"></script>
<script src="public/js/notification.js"></script>
<script src="public/js/header.js"></script>
<script>
    loadChange("table", function () {
        $.ajax({
            url: "load-table.php",
            data: {
                <?php
                if (!isset($_GET['is_empty'])) {
                    echo '"is_empty" : "null"';
                } else if ($_GET['is_empty'] == 'true') {
                    echo '"is_empty" : "true"';
                } else if ($_GET['is_empty'] == 'false') {
                    echo '"is_empty" : "false"';
                }
                ?>
            },
            type: "POST",
            success: function (data) {
                $(document).ready(function () {
                    $('#loaded').hide();
                    $('#loaded-data-table').html(data);
                });
            }
        })
    })

    $(document).on("click", ".table-clean", function () {
        var id = $(this).attr('data');
        $.ajax({
            url: "load-clean-table.php",
            data: {
                "id": id
            },
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $(document).ready(function () {
                    $('#loaded').hide();
                    PrintElem("print-order");
                    $('#cart-item').html("");
                    $("#table-detail-modal").modal('toggle');
                });
            }
        })
    })

    $(document).on("click", ".redirect", function () {
        window.location.replace($(this).attr("datahref"));
    })

    $(document).on("click", ".load-table-detail", function () {
        var id = $(this).attr('data');
        $.ajax({
            url: "load-table-detail.php",
            data: {
                "id": id
            },
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $(document).ready(function () {
                    $('#loaded').hide();
                    $('#cart-item').html(data);
                    $("#table-detail-modal").modal('toggle');
                });
            }
        })
    })

    function PrintElem(elem) {
        var mywindow = window.open('', 'PRINT', 'height=400,width=600');
        mywindow.document.write('<html><head><title>CHB Coffe</title>');
        mywindow.document.write('</head><body >');
        mywindow.document.write(document.getElementById(elem).innerHTML);
        mywindow.document.write('<p style="text-align: center;">Nhân viên thanh toán: <?php echo $_SESSION['_userSignedIn']->getName() ?> </p>')
        mywindow.document.write('<style>button{visibility: hidden;}</style>');
        mywindow.document.write('</body></html>');
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        return true;
    }
</script>
</body>
</html>