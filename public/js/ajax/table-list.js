$(document).ready(function () {
    /*Load change list drinks*/
    loadChange("table", function () {
        $.ajax({
            url: "a-load-table-admin.php",
            type: "POST",
            success: function (data) {
                $('#data-list-table').html(data)
            }
        })
    })
})

$(document).on("click", ".btn-del-table", function () {
    const r = confirm('Bạn có chắc chắn muốn đóng ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-delete-table-admin.php",
            data: {
                'id': $(this).attr('data')
            },
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                if (data == 'true')
                    createAlert("success", "Ngưng hoạt động bàn thành công!");
                else
                    createAlert("warning", "Ngưng hoạt động bàn thất bại!");
            }
        })
    }
})

$(document).on("click", ".btn-reactive-table", function () {
    const r = confirm('Bạn có chắc chắn muốn mở lại ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-reactive-table-admin.php",
            data: {
                'id': $(this).attr('data')
            },
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                if (data == 'true')
                    createAlert("success", "Bàn mở hoạt động thành công!");
                else
                    createAlert("warning", "Bàn mở hoạt động thất bại!");
            }
        })
    }
})

$(document).on("click", ".btn-edit-table", function () {
    $.ajax({
        url: "a-load-table-detail-admin.php",
        data: {
            'id': $(this).attr('data')
        },
        type: "POST",
        beforeSend: function () {
            $('#loaded').show();
        },
        success: function (data) {
            $('#loaded').hide();
            if (data == 'false')
                createAlert("warning", "Lấy thông tin bàn phẩm thất bại!");
            else {
                $('#model-edit-content').html(data)
                $("#editTableModal").modal('toggle')
            }
        }
    })
})

$(document).on("click", ".btn-del-empty-table", function() {
    const r = confirm('Bạn có chắc chắn muốn xóa vĩnh viễn ' + $(this).attr('name') + ' không ?');
    if (r == true) {
        $.ajax({
            url: "a-delete-empty-table-admin.php",
            data: {
                'id': $(this).attr('data')
            },
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                if (data == 'double')
                    createAlert("warning", "Bàn không thể xóa do tồn tại hóa đơn!");
                else if (data == 'true')
                    createAlert("success", "Xóa bàn thành công!");
                else
                    createAlert("warning", "Xóa bàn thất bại!");
            }
        })
    }
})


$(document).on("click", "#btn-edit-table", function () {
    const $pr_name = $('#txt-name')

    /*Empty error label*/
    function emptyError() {
        $('#error-name').html('')
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
        data.append('id', $(this).attr('data'));
        data.append('name', $('#txt-name').val());

        $.ajax({
            url: 'a-check-edit-table.php',
            data: data,
            type: "POST",
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                if (data == 'true') {
                    $("#editTableModal").modal('toggle')
                    createAlert("success", "Chỉnh sửa bàn thành công!");
                } else if (data == 'double') {
                    $('#error-name').html('Tên đã tồn tại')
                } else {
                    createAlert("warning", "Xử lý lỗi!");
                    checkForm();
                }
            }
        })
    }
})