$(document).ready(function () {
    $('#loaded').show();
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

$(document).on('click','.btn-update-order',function () {
    $.ajax({
        url : 'a-update-order-detail'
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