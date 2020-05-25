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
<header class="navbar-manager -bg-darkblue fixed-top">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li>
                    <a href="manager.php"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Table
                        <div class="hr-panel-tab"></div>
                    </a>
                </li>
                <li class="active"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                    <div class="hr-panel-tab"></div>
                </li>
            </ul>
        </div>
        <div class="status-tab">
            <ul id="active-status">
                <li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p>0</p> <span>/</span>
                    <p>0</p><label>Active table</label>
                </li>
            </ul>
        </div>
    </div>
</header>
<section style="margin-top: 70px;">
    <div id="loaded">
        <div class="loading">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="loading-overlay"></div>
    </div>
    <div class="row manager-desk" id="load-data-drinks">
    </div>
</section>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">Chọn bàn cho khách hàng</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-bottom: 50px;">
                <ul class="card-box-desk" id="loaded-data-table">

                </ul>
            </div>
        </div>
    </div>
</div>
<div id="table-event-change">

</div>
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src="public/asset/js/bootstrap.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-database.js"></script>
<script src="public/js/firebase-reload-data-event.js"></script>
<script !src="">
    $(document).ready(function () {
        $(document).on('click', ".card-list", function () {
            if ($(this).hasClass("disable")) {
                $(".card-list").addClass("disable");
                $(this).removeClass("disable");
                $(this).removeClass("disable");
            } else {
                if ($(".card-list.disable").length == 0) {
                    $(".card-list").addClass("disable");
                    $(this).removeClass("disable");
                } else {
                    $(".card-list").removeClass("disable");
                }
            }
        })

        $(document).on('click', ".choose-table-cart", function () {
            $.ajax({
                url: "handle-cart.php",
                data: 'action=payment&code=' + $(this).attr("table-id"),
                type: "POST",
                beforeSend : function (){
                    $('#loaded').show();
                },
                success: function (data) {
                    $('#loaded').hide();
                    createAlert("success", "Thanh toán thành công!");
                    $("#exampleModalLong").modal('toggle');
                    $("#cart-item").html(data);
                },
                error: function () {
                }
            });
        })
        $(document).on("click", ".scrool-list", function () {
            $('html, body').animate({
                scrollTop: $("#" + $(this).attr("data")).offset().top - 75
            }, 500);
        })

    })

    function cartAction(action, product_code) {
        var queryString = "";
        if (action != "") {
            switch (action) {
                case "add":
                    queryString = 'action=' + action + '&code=' + product_code;
                    break;
                case "remove":
                    queryString = 'action=' + action + '&code=' + product_code;
                    break;
                case "empty":
                    queryString = 'action=' + action;
                    break;
            }
        }
        $.ajax({
            url: "handle-cart.php",
            data: queryString,
            type: "POST",
            success: function (data) {
                $("#cart-item").html(data);
                if (action != "") {
                    switch (action) {
                        case "add" :
                            createAlert("success", "Đã thêm vào hàng chờ!");
                            break;
                        case "remove":
                            createAlert("warning", "Đã xóa khỏi hàng chờ!");
                            $("#add_" + product_code).show();
                            $("#added_" + product_code).hide();
                            break;
                        case "empty":
                            createAlert("danger", "List is empty!");
                            $(".btnAddAction").show();
                            $(".btnAdded").hide();
                            break;
                    }
                }
            },
            error: function () {
            }
        });
    }
</script>
<script src="public/js/notification.js"></script>
<script>
    loadChange("list", function () {
        $.ajax({
            url: "load-drink.php",
            type: "POST",
            beforeSend : function (){
                $('#loaded').show();
            },
            success: function (data) {
                $(document).ready(function () {
                    $('#loaded').hide();
                    $('#load-data-drinks').html(data);
                });
            }
        })
    })

    loadChange("table", function () {
        $.ajax({
            url: "load-table-status.php",
            type: "POST",
            beforeSend : function (){
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                $('#table-event-change').html(data);
            }
        })
    })
</script>
</body>
</html>