$(document).ready(function () {
    const $txtName = $('#txt-name')

    /*Event change value input name - check*/
    $txtName.on('input change', () => {
        if (isValidName($txtName.val())) {
            $('#name-preview').html($txtName.val())
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
        if (isValidName($txtName.val())) {
            $('#error-name').html('')
        } else {
            $('#error-name').html('Tên là ký tự chữ số dài từ 2 - 200 ký tự')
            a = false
        }
        if(a) emptyError()
        return a;
    }

    /*Ajax event submit*/
    $("#btn-add-product").click(function () {
        if (checkForm()) {
            const data = new FormData();
            const isActive = ($('#switch1').is(":checked")) ? true : false;
            data.append('name', $('#txt-name').val());
            data.append('description', $('#txt-description').val());
            data.append('isActive', isActive);
            $.ajax({
                url: 'a-check-add-list.php',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data == 'true'){
                        alert("Thêm danh sách thành công!");
                        location.reload();
                    }else if(data == 'double'){
                        $('#error-name').html('Tên đã tồn tại')
                    }else{
                        alert("Xử lý lỗi!");
                        checkForm();
                    }
                }
            })
        }
    })
});