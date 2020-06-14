$(document).ready(function () {
    $('#loaded').show();
})

//Card acction
function cartAction(action, product_code) {
    var queryString = "";
    if (action != "") {
        switch (action) {
            case "add":
                queryString = 'action=' + action + '&code=' + product_code;
                break;
            case "remove":
                queryString = 'action=' + action + '&code=' + product_code;
                break;
            case "empty":
                queryString = 'action=' + action;
                break;
        }
    }

    $.ajax({
        url: "a-handle-cart.php",
        data: queryString,
        type: "POST",
        beforeSend : function(){
            $("#cart-item table").after('<p id="loading-svg" style="width: 100%; text-align: center">\n' +
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
            $("#cart-item").html(data);
            if (action != "") {
                switch (action) {
                    case "add" :
                        createAlert("success", "Đã thêm vào hàng chờ!");
                        break;
                    case "remove":
                        createAlert("warning", "Đã xóa khỏi hàng chờ!");
                        $("#add_" + product_code).show();
                        $("#added_" + product_code).hide();
                        break;
                    case "empty":
                        createAlert("danger", "List is empty!");
                        $(".btnAddAction").show();
                        $(".btnAdded").hide();
                        break;
                }
            }
        },
        error: function () {
        }
    });
}

//Load change list drinks
loadChange("food", function () {
    $.ajax({
        url: "a-load-drink.php",
        type: "POST",
        beforeSend: function () {
            $('#loaded').show()
        },
        success: function (data) {
            $(document).ready(function () {
                $('#loaded').hide();
                $('#load-data-drinks').html(data);
            });
        }
    })
})

//Load change list drinks
loadChange("list", function () {
    $.ajax({
        url: "a-load-drink.php",
        type: "POST",
        beforeSend: function () {
            $('#loaded').show();
        },
        success: function (data) {
            $(document).ready(function () {
                $('#loaded').hide();
                $('#load-data-drinks').html(data);
            });
        }
    })
})

//Load change list Table
loadChange("table", function () {
    $.ajax({
        url: "a-load-table-status.php",
        type: "POST",
        success: function (data) {
            $(document).ready(function () {
                $('#loaded-data-table').html(data);
            });
        }
    })
})

$(document).ready(function () {
    //Handle when choose over valid number
    $(document).on('click', ".card-list", function () {
        if ($(this).hasClass("disable")) {
            $(".card-list").addClass("disable");
            $(this).removeClass("disable");
            $(this).removeClass("disable");
        } else {
            if ($(".card-list.disable").length == 0) {
                $(".card-list").addClass("disable");
                $(this).removeClass("disable");
            } else {
                $(".card-list").removeClass("disable");
            }
        }
    })

    //Load table status for choose
    $(document).on('click', ".choose-table-cart", function () {
        $.ajax({
            url: "a-handle-cart.php",
            data: 'action=payment&code=' + $(this).attr("table-id"),
            type: "POST",
            beforeSend: function () {
                $('#loaded').show();
            },
            success: function (data) {
                $('#loaded').hide();
                createAlert("success", "Thêm đơn thành công!");
                $("#exampleModalLong").modal('toggle');
                $("#cart-item").html(data);
            },
            error: function () {
            }
        });
    })

    //Event scroll list card
    $(document).on("click", ".scrool-list", function () {
        $('html, body').animate({
            scrollTop: $("#" + $(this).attr("data")).offset().top - 75
        }, 500);
    })
})