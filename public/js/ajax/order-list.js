$(document).ready(function () {
    $('#loaded').hide();
    /*Load change list drinks*/
    loadChange("orders", function () {
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
})

$(document).on('click','#btn-load-more',function () {
    $.ajax({
        url: "a-load-more-order-admin.php",
        data : {
            'id' : $(this).attr('data'),
            'order' : $(this).attr('order')
        },
        type: "POST",
        beforeSend: function(){
            $('#data-order-table tr:last td').html('<img src="https://i.ya-webdesign.com/images/loading-png-gif.gif" width="50px">')
        },
        success: function (data) {
           if(data == 'null'){
                $('#data-order-table tr:last td').html('Đã tải hết dữ liệu.')
           }else{
               $('#data-order-table tr:last').remove()
               $('#data-order-table').append(data)
           }
        }
    })
})

$(document).on('click','.btn-view-detail',function () {
    $.ajax({
        url: "a-load-detail-order-admin.php",
        data : {
            'id' : $(this).attr('data')
        },
        type: "POST",
        beforeSend: function(){
            $('#loaded').show();
        },
        success: function (data) {
            if(data == 'null'){
                $('#loaded').hide();
                $('#model-detail-content').html('Dữ liệu lỗi.')
            }else{
                $('#loaded').hide();
                $('#model-detail-content').html(data)
                $("#orderDetailModal").modal('toggle')
            }
        }
    })
})