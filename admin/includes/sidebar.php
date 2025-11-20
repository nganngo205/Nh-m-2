<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$managePages = ['tuyensinh.php', 'nganh.php', 'sinhvien.php', 'contact.php'];
$isManaging = in_array($currentPage, $managePages);

// Tính toán đường dẫn tương đối
$prefix = strpos($_SERVER['SCRIPT_NAME'], '/manage/') !== false ? '../' : '';
?>

<div class="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <h2>TRANG QUẢN TRỊ VIÊN</h2>
    </div>

    <ul class="sidebar-menu">

        <!-- Trang chủ -->
        <!-- Quản lý -->
        <li class="submenu-wrapper">
            <span class="submenu-title">
                ⚙️ Quản lý hệ thống
            </span>

            <ul class="submenu active">
                <li>
                    <a href="<?= $prefix ?>index.php?manage=tuyensinh"
                       class="menu-link <?= $currentPage === 'tuyensinh.php' ? 'active' : '' ?>">
                       • Tuyển sinh
                    </a>
                </li>

                <li>
                    <a href="<?= $prefix ?>index.php?manage=nganh"
                       class="menu-link <?= $currentPage === 'nganh.php' ? 'active' : '' ?>">
                       • Ngành đào tạo
                    </a>
                </li>

                <li>
                    <a href="<?= $prefix ?>index.php?manage=sinhvien"
                       class="menu-link <?= $currentPage === 'sinhvien.php' ? 'active' : '' ?>">
                       • Hoạt động sinh viên
                    </a>
                </li>

                <li>
                    <a href="<?= $prefix ?>index.php?manage=contact"
                       class="menu-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>">
                       • Liên hệ
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="<?= $prefix ?>../index.php" class="menu-link">
                🏠 Trang thông tin
            </a>
        </li>

        <!-- Đăng xuất -->
        <li>
            <a href="<?= $prefix ?>../logout.php" class="logout-btn menu-link">
                ↪️ Đăng xuất
            </a>
        </li>

    </ul>
</div>

<style>
/* Khung sidebar */
.sidebar {
    width: 320px;
    background: #05389F;
    color: white;
    height: 100vh;
    padding: 0;
    box-shadow: 4px 0 12px rgba(0,0,0,0.15);
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
}

/* Header */
.sidebar-header {
    padding: 40px;
    background: #042B7A;
    text-align: center;
    border-bottom: 2px solid #FFA500;
}

.sidebar-header h2 {
    font-size: 23px;
    color: #FFA500;
    margin: 0;
}

/* Menu */
.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.sidebar-menu li {
    margin: 5px 0;
}

/* Link chung */
.menu-link {
    display: block;
    padding: 16px 22px;
    font-size: 20px;
    color: #fff;
    text-decoration: none;
    border-radius: 6px;
    transition: 0.25s ease;
}

.menu-link:hover {
    background: rgba(255,255,255,0.2);
}

/* Submenu luôn hiển thị */
.submenu-wrapper {
    margin-top: 10px;
}

.submenu-title {
    display: block;
    font-size: 20px;
    font-weight: bold;
    padding: 16px 22px;
}

.submenu {
    display: block;
    padding-left: 10px;
    margin-top: 5px;
}

/* Link submenu */
.submenu a {
    padding: 12px 22px;
    font-size: 19px;
    opacity: 0.95;
}

.submenu a:hover {
    background: rgba(255,255,255,0.2);
}

/* Active */
.submenu a.active {
    background: #FFA500;
    color: #000;
    font-weight: bold;
}

/* Logout */
.logout-btn {
    background: transparent;
    transition: 0.3s ease;
    color: #fff;
}
.logout-btn:hover {
    background: #E53935;
    color: #fff;
}
</style>
