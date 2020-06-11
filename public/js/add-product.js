$(document).ready(function () {
    const $valueSpan = $('#show-range-percent')
    const $value = $('#txt-range-sale')
    const $pr_name = $('#txt-name')
    const $pr_price = $('#txt-price')
    const $pr_isSale = $('#switch1')
    const $pr_sale = $('#txt-range-sale')
    const $pr_image = $('#txt-file')
    /*Change input range*/
    $valueSpan.html($value.val())

    /*Event change value input range*/
    $value.on('input change', () => {
        $valueSpan.html($value.val());
    })

    /*Event change value input name - check*/
    $pr_name.on('input change', () => {
        if (isValidName($pr_name.val())) {
            $('#name-preview').html($pr_name.val())
            $('#error-name').html('')
        } else {
            $('#error-name').html('Tên là ký tự chữ số dài từ 2 - 50 ký tự')
        }
    })

    /*Event change value input price - check*/
    $pr_price.on('input change', () => {
        if (isNaturalNumber($pr_price.val())) {
            if (Number($pr_price.val()) > 500000) {
                $('#error-price').html('Tiền có giá trị 0 - 500.000')
            } else {
                changePrice()
                $('#error-price').html('')
            }
        } else {
            $('#error-price').html('Tiền là giá trị số dương')
        }
    })

    /*Event change value input price - check*/
    $pr_sale.on('input change', () => {
        changePrice()
    })

    /*Event change value input checkbox - check*/
    $pr_isSale.on('input change', () => {
        changePrice()
    })

    /*Event change value input image - check*/
    $pr_image.change(function () {
        readURL(this)
    })

    /*Function check value price - check*/
    function changePrice() {
        if ($('#switch1').is(":checked")) {
            if ($pr_sale.val() != 0 && $pr_price.val() != '') {
                $('#price-sale-preview').html(formatNumber($pr_price.val()) + "  ₫")
                $('#price-preview').html(formatNumber($pr_price.val() - $pr_price.val() / 100 * $pr_sale.val()) + "  ₫")
                $('#sale-preview').show()
                $('#sale-preview').html($pr_sale.val() + "%")
            } else {
                $('#price-preview').html(formatNumber($pr_price.val()) + "  ₫")
                $('#price-sale-preview').html('')
                $('#sale-preview').hide()
            }
        } else {
            $('#price-preview').html(formatNumber($pr_price.val()) + "  ₫")
            $('#price-sale-preview').html('')
            $('#sale-preview').hide()
        }
    }

    /*Empty error label*/
    function emptyError() {
        $('#error-image').html('')
        $('#error-price').html('')
        $('#error-name').html('')
        $('#error-description').html('')
        $('#error-issale').html('')
    }

    /*Function check value form*/
    function checkForm() {
        var a = true
        if (isNaturalNumber($pr_price.val())) {
            if (Number($pr_price.val()) > 500000) {
                $('#error-price').html('Tiền có giá trị 0 - 500.000')
                a = false
            } else {
                $('#error-price').html('')
            }
        } else {
            $('#error-price').html('Tiền là giá trị số dương')
            a = false
        }

        if (isValidName($pr_name.val())) {
            $('#error-name').html('')
        } else {
            $('#error-name').html('Tên là ký tự chữ số dài từ 2 - 50 ký tự')
            a = false
        }

        if($('#txt-file')[0].files[0] == null){
            $('#error-image').html('Chưa chọn hình ảnh!')
            a = false
        }else{
            $('#error-image').html('')
        }
        if(a) emptyError()
        return a;
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var filename = $('#txt-file')[0].files[0]['name'];
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
                $('#lb-txt-file').text('Đã chọn');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function formatNumber(n) {
        n = Number(n)
        return n.toFixed(0).replace(/./g, function (c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
        });
    }

    /*Ajax event submit*/
    $("#btn-add-product").click(function () {
        if (checkForm()) {
            const data = new FormData();
            const file = $('#txt-file')[0].files[0];
            const isSale = ($('#switch1').is(":checked")) ? true : false;
            data.append('file', file);
            data.append('name', $('#txt-name').val());
            data.append('list', $('#txt-list').val());
            data.append('description', $('#txt-description').val());
            data.append('isSale', isSale);
            data.append('price', $('#txt-price').val());
            data.append('rangeSale', $('#txt-range-sale').val());

            $.ajax({
                url: 'check-add-product.php',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function (data) {
                    if(data == 'true'){
                        alert("Thêm sản phẩm thành công!");
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