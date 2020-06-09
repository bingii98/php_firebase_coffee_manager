//DARK THEME
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
const currentTheme = localStorage.getItem('theme');

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', '__dark-mode');
        localStorage.setItem('theme', '__dark-mode');
    } else {
        document.documentElement.setAttribute('data-theme', '__light-mode');
        localStorage.setItem('theme', '__light-mode');
    }
}

toggleSwitch.addEventListener('change', switchTheme, false);
$(document).ready(function () {
    document.documentElement.setAttribute('data-theme', currentTheme);
    if (currentTheme === '__light-mode') {
        toggleSwitch.checked = false;
    } else {
        toggleSwitch.checked = true;
    }
})

$("#btn-reset-password").click(function () {
    $.ajax({
        url: "reset-password.php",
        type: "POST",
        success: function (data) {
            createAlert("success", "Đường dẫn đổi mật khẩu đã được gửi đến email của bạn!");
        }
    })
})