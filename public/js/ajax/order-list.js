$(document).ready(function () {
    $('#loaded').hide();
    /*Load change list drinks*/
    $.ajax({
        url: "a-load-order-admin.php",
        type: "POST",
        success: function (data) {
            $(document).ready(function () {
                $('#data-order-table').html(data);
            });
        }
    })
})

$(document).on('click', '#btn-load-more', function () {
    $.ajax({
        url: "a-load-more-order-admin.php",
        data: {
            'id': $(this).attr('data'),
            'order': $(this).attr('order')
        },
        type: "POST",
        beforeSend: function () {
            $('#data-order-table tr:last td').html('<vector src="https://i.ya-webdesign.com/images/loading-png-gif.gif" width="50px">')
            $("#order-last-row td").append('<p id="loading-svg" style="width: 100%; text-align: center">\n' +
                '            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">\n' +
                '                    <rect x="0" y="7.337" width="4" height="15.326" fill="#333" opacity="0.2">\n' +
                '                        <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                        <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                        <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                    </rect>\n' +
                '                <rect x="8" y="9.837" width="4" height="10.326" fill="#333" opacity="0.2">\n' +
                '                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.15s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                </rect>\n' +
                '                <rect x="16" y="7.663" width="4" height="14.674" fill="#333" opacity="0.2">\n' +
                '                    <animate attributeName="opacity" attributeType="XML" values="0.2; 1; .2" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                    <animate attributeName="height" attributeType="XML" values="10; 20; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                    <animate attributeName="y" attributeType="XML" values="10; 5; 10" begin="0.3s" dur="0.6s" repeatCount="indefinite"></animate>\n' +
                '                </rect>\n' +
                '            </svg>\n' +
                '        </p>')
        },
        success: function (data) {
            if (data == 'null') {
                $('#data-order-table tr:last td').html('Đã tải hết dữ liệu.')
            } else {
                $('#data-order-table tr:last').remove()
                $('#data-order-table').append(data)
            }
        }
    })
})

$(document).on('click', '.btn-view-detail', function () {
    $.ajax({
        url: "a-load-detail-order-admin.php",
        data: {
            'id': $(this).attr('data')
        },
        type: "POST",
        beforeSend: function () {
            $('#loaded').show();
        },
        success: function (data) {
            if (data == 'null') {
                $('#loaded').hide();
                $('#model-detail-content').html('Dữ liệu lỗi.')
            } else {
                $('#loaded').hide();
                $('#model-detail-content').html(data)
                $("#orderDetailModal").modal('toggle')
            }
        }
    })
})