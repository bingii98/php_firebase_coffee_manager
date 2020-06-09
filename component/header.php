<header class="navbar-manager -bg-darkblue fixed-top">
    <div class="container-fluid" style="display: flex;">
        <div class="panel-tab">
            <ul>
                <li id="header-table">
                    <a href="manager.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Table
                        <div class="hr-panel-tab"></div>
                    </a>
                <li id="header-drink">
                    <a href="drinks.php"><i class="fa fa-coffee" aria-hidden="true"></i>&nbsp;&nbsp;Drink
                        <div class="hr-panel-tab"></div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="status-tab">
            <ul id="active-status">
                <li><i class="fa fa-microchip" aria-hidden="true"></i>&nbsp;&nbsp;<p>0</p> <span>/</span>
                    <p>0</p><label>Active table</label>
                </li>
            </ul>
        </div>
        <div class="account-tab">
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if($_SESSION['_userSignedIn']->getName() != null) echo $_SESSION['_userSignedIn']->getName(); else echo $_SESSION['_userSignedIn']->getEmail() ?>
                </button>
                <div class="dropdown-menu bg-menu-dropdown" aria-labelledby="dropdownMenu">
                    <a class="dropdown-item" href="user-info.php"><i class="fa fa-user" aria-hidden="true"></i><span>Đổi thông tin</span></a>
                    <button class="dropdown-item" type="button" id="btn-reset-password"><i class="fa fa-unlock-alt" aria-hidden="true"></i><span>Đổi mật khẩu</span></button>
                    <div class="dropdown-divider"></div>
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
<!-- Modal -->
<div class="modal fade" id="user-change-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true" style="margin-top: 70px;">
    <div class="modal-dialog" role="document" id="print-order">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <h4 style="text-align: center;width: 100%;font-weight: bold;margin-top: 35px;margin-bottom: 17px;">Thông tin tài khoản</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cart-item" style="margin: 0;box-shadow: none;padding: 0 21px;"></div>
            </div>
        </div>
    </div>
</div>