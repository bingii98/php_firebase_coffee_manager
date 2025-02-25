<header class="navbar-manager -bg-darkblue fixed-top">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li id="header-table">
                    <a href="staff-manager.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Quản lý
                        <div class="hr-panel-tab"></div>
                    </a>
                <li id="header-drink">
                    <a href="staff-drinks.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Đặt món
                        <div class="hr-panel-tab"></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="status-tab">
            <ul id="active-status">
                <li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p>0</p> <span>/</span>
                    <p>0</p><label>Bàn hoạt động</label>
                </li>
            </ul>
        </div>
        <div class="account-tab">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($_SESSION['_userSignedIn']->getName() != null) echo $_SESSION['_userSignedIn']->getName(); else echo $_SESSION['_userSignedIn']->getEmail() ?>
                </button>
                <div class="dropdown-menu bg-menu-dropdown" aria-labelledby="dropdownMenu">
                    <a class="dropdown-item" href="staff-user-info.php"><i class="fa fa-user" aria-hidden="true"></i><span>Đổi thông tin</span></a>
                    <button class="dropdown-item" type="button" id="btn-reset-password"><i class="fa fa-unlock-alt" aria-hidden="true"></i><span>Đổi mật khẩu</span></button>
                    <div class="dropdown-divider"></div>
                    <?php if($_SESSION['_userSignedIn']->getIsAdmin()){ ?>
                        <a class="dropdown-item" href="admin.php"><i class="fa fa-cog" aria-hidden="true"></i><span>Giao diện quản lý</span></a>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                    <div class="dropdown-item theme-switch-wrapper" id="switch-dark-mode">
                        <i class="fa fa-star-half-o" aria-hidden="true"></i><span>Chế độ ban đêm</span>
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox"/>
                            <div class="slider round"></div>
                        </label>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i><span>Đăng xuất</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
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
    document.documentElement.setAttribute('data-theme', currentTheme);
    if (currentTheme === '__light-mode') {
        toggleSwitch.checked = false;
    } else {
        toggleSwitch.checked = true;
    }
</script>