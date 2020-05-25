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
    <link rel="stylesheet" href="public/asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<header class="navbar-manager -bg-darkblue fixed-top">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li class="active"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Table
                    <div class="hr-panel-tab"></div>
                </li>
                <li>
                    <a href="drinks.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                        <div class="hr-panel-tab"></div>
                    </a>
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
            <h5>CONTROL PANEL</h5>
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
<script src="public/asset/js/jquery-3.5.1.min.js"></script>
<script src="public/asset/js/bootstrap.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.4/firebase-database.js"></script>
<script src="public/js/firebase-reload-data-event.js"></script>
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
                    $('.modal-backdrop').remove();
                    $('#loaded').hide();
                    $('#loaded-data-table').html(data);
                });
            }
        })
    })

    $(document).on("click",".redirect",function () {
        window.location.replace($(this).attr("datahref"));
    })
</script>
</body>
</html>