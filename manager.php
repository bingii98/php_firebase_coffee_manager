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
<header class="navbar-manager -bg-darkblue">
    <div class="container" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li class="active"><i class="fa fa-cubes" aria-hidden="true"></i>&nbsp;&nbsp;Table
                    <div class="hr-panel-tab"></div>
                </li>
                <li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                    <div class="hr-panel-tab"></div>
                </li>
            </ul>
        </div>
        <div class="status-tab">
            <ul>
                <li><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;<p>09</p> <span>/</span> <p>34</p><label>Active table</label>
                </li>
            </ul>
        </div>
    </div>
</header>
<section>
    <div class="row manager-desk">
        <div class="slidebar col-3">
            <h5>CONTROL PANEL</h5>
            <ul class="list-desk">
                <li class="header">Loại bàn <i class="fa fa-cubes" aria-hidden="true"></i></li>
                <li class="item"><p>Bàn trống</p><i class="fa fa-caret-right" aria-hidden="true"></i></li>
                <li class="item"><p>Bàn có người</p><i class="fa fa-caret-right" aria-hidden="true"></i></li>
            </ul>
            <ul class="list-desk-detail">
                <li class="header">Chi tiết <i class="fa fa-coffee" aria-hidden="true"></i></li>
                <li class="item"><p>Bàn 1</p><i>1</i></li>
                <li class="item"><p>Bàn 2</p><i>2</i></li>
                <li class="item"><p>Bàn 3</p><i>4</i></li>
                <li class="item"><p>Bàn 4</p><i>4</i></li>
            </ul>
        </div>
        <div class="content col-8">
            <ul class="card-box-desk">
                <li class="card-list active"><lable>Bàn 1</lable></li>
                <li class="card-list"><label>Bàn 2</label></li>
                <li class="card-list"><label>Bàn 3</label></li>
                <li class="card-list"><label>Bàn 4</label></li>
                <li class="card-list"><label>Bàn 5</label></li>
                <li class="card-list"><label>Bàn 6</label></li>
                <li class="card-list"><label>Bàn 7</label></li>
                <li class="card-list"><label>Bàn 8</label></li>
                <li class="card-list"><label>Bàn 9</label></li>
                <li class="card-list"><label>Bàn 10</label></li>
            </ul>
        </div>
    </div>
</section>
</body>
</html>