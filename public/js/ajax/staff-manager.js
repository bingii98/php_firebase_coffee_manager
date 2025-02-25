var first = true;

$(document).ready(function () {
    $('#loaded').show();
})

loadChangeAdd("orders", function (data) {
    if (first) {
        first = false
    } else {
        document.getElementById("sound-messenger").play()
        createAlert('warning', 'Cảnh báo có khách hàng đặt món!')
    }
})

$(document).on("click", ".table-clean", function () {
    var id = $(this).attr('data');
    $.ajax({
        url: "a-load-clean-table.php",
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

$(document).on('click', '.swap-table', function () {
    $("#table-swap-modal").modal('toggle');
    $("[data-receive=" + $(this).attr('data-send')).html('Bàn hiện tại').prop('disabled', true).css('cursor','not-allowed');
    $("#table-swap-modal .choose-table-swap").attr("data-send", $(this).attr('data-send'));
})

$(document).on('click', '.choose-table-swap', function () {
    var idSend = $(this).attr('data-send');
    var idReceive = $(this).attr('data-receive');
    $.ajax({
        url: "a-swap-table.php",
        data: {
            "idSend": idSend,
            "idReceive": idReceive
        },
        type: "POST",
        beforeSend: function () {
            $('#loaded').show();
        },
        success: function (data) {
            $("#table-swap-modal").modal('toggle');
            $(".modal-backdrop").remove();
            $('#loaded').hide();
        }
    })
})

$(document).on("click", ".redirect", function () {
    window.location.replace($(this).attr("datahref"));
})

$(document).on("click", ".load-table-detail", function () {
    var id = $(this).attr('data');
    $.ajax({
        url: "a-load-table-detail.php",
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

loadChange("table", function () {
    $.ajax({
        url: "a-load-table.php",
        data: {
            "is_empty": a
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

$(document).on('click', '.btn-update-order', function () {
    $.ajax({
        url: 'a-update-order.php',
        data: {
            'id_order': $(this).attr('data_order'),
            'id_table': $(this).attr('data_table')
        },
        type: 'POST',
        beforeSend: function () {
            $('#loaded').show();
        },
        success: function (data) {
            $(document).ready(function () {
                $('#loaded').hide();
                $('#cart-item').html(data);
            });
        }
    })
})

function PrintElem(elem) {
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    mywindow.document.write('<html><head><title>CHB Coffe</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('<p style="text-align: center;">Nhân viên thanh toán:  ' + b + '</p>')
    mywindow.document.write('<style>button{visibility: hidden;}</style>');
    mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.focus();
    mywindow.print();
    return true;
}