$(document).ready(function () {
    /*Load change list drinks*/
    loadChange("list", function () {
        $.ajax({
            url: "a-load-list-admin.php",
            type: "POST",
            success: function (data) {
                $(document).ready(function () {
                    $('#data-list-table').html(data);
                });
            }
        })
    })
})

$(document).on("click", ".btn-del-list", function() {
    const r = confirm('Bạn có chắc chắn muốn ngừng ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-delete-list-admin.php",
            data: {
                'id': $(this).attr('data')
            },
            type: "POST",
            success: function (data) {
                if (data == 'true')
                    alert("Ngưng hoạt động danh sách thành công!")
                else
                    alert("Ngưng hoạt động danh sách thất bại!")
            }
        })
    }
})

$(document).on("click", ".btn-reactive-list", function () {
    const r = confirm('Bạn có chắc chắn muốn mở lại ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-reactive-list-admin.php",
            data: {
                'id': $(this).attr('data')
            },
            type: "POST",
            success: function (data) {
                if (data == 'true')
                    alert("Danh sách đã mở lại thành công!")
                else
                    alert("Danh sách mở lại thất bại!")
            }
        })
    }
})

$(document).on("click", ".btn-edit-list", function () {
    $.ajax({
        url: "a-load-list-detail.php",
        data: {
            'id': $(this).attr('data')
        },
        type: "POST",
        success: function (data) {
            if (data == 'false')
                alert("Lấy thông tin danh sách thất bại!")
            else {
                $('#model-edit-content').html(data)
                $("#editProductModal").modal('toggle')
            }
        }
    })
})

$(document).on("click", "#btn-edit-list", function () {
    const $pr_name = $('#txt-name')

    /*Event change value input name - check*/
    $pr_name.on('input change', function() {
        if (isValidName($pr_name.val())) {
            $('#name-preview').html($pr_name.val())
            $('#error-name').html('')
        } else {
            $('#error-name').html('Tên là ký tự chữ số dài từ 2 - 200 ký tự')
        }
    })

    /*Empty error label*/
    function emptyError() {
        $('#error-name').html('')
        $('#error-description').html('')
    }

    /*Function check value form*/
    function checkForm() {
        var a = true

        if (isValidName($pr_name.val())) {
            $('#error-name').html('')
        } else {
            $('#error-name').html('Tên là ký tự chữ số dài từ 2 - 200 ký tự')
            a = false
        }
        if (a) emptyError()
        return a;
    }

    /*Ajax event submit*/
    if (checkForm()) {
        const data = new FormData();
        const isSale = ($('#switch1').is(":checked")) ? true : false;
        data.append('id', $(this).attr('data'));
        data.append('name', $('#txt-name').val());
        data.append('description', $('#txt-description').val());

        $.ajax({
            url: 'a-check-edit-list.php',
            data: data,
            type: "POST",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == 'true') {
                    $("#editProductModal").modal('toggle')
                    alert("Chỉnh sửa danh sách thành công!");
                } else if (data == 'double') {
                    $('#error-name').html('Tên đã tồn tại')
                } else {
                    alert("Xử lý lỗi!");
                    checkForm();
                }
            }
        })
    }
})