$(document).ready(function () {
    /*Load change list drinks*/
    loadChange("food", function () {
        $.ajax({
            url: "a-load-product-admin.php",
            type: "POST",
            success: function (data) {
                $(document).ready(function () {
                    $('#data-food-table').html(data);
                });
            }
        })
    })
})

$(document).on("click",".btn-del-product",function () {
    var r = confirm('Bạn có chắc chắn muốn ngừng bán ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-delete-product-admin.php",
            data : {
                'id' :  $(this).attr('data')
            },
            type: "POST",
            success: function (data) {
                if(data == 'true')
                    alert("Ngưng hoạt động sản phẩm thành công!")
                else
                    alert("Ngưng hoạt động sản phẩm thất bại!")
            }
        })
    }
})

$(document).on("click",".btn-reactive-product",function () {
    var r = confirm('Bạn có chắc chắn muốn bán lại ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-reactive-product-admin.php",
            data : {
                'id' :  $(this).attr('data')
            },
            type: "POST",
            success: function (data) {
                if(data == 'true')
                    alert("Sản phẩm đã được bán lại thành công!")
                else
                    alert("Sản phẩm đã được bán lại thất bại!")
            }
        })
    }
})