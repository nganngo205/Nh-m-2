<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

// Lấy tham số ?page trên URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trường Đại học Thương mại - TMU</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    .main-nav a.active {
      color: orange;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <!-- HEADER -->
  <header>
    <div class="header-top">
      <div class="header-container header-top-wrap logo-home">
        <!-- Bên trái: Logo -->
        <div class="header-left">
          <a class="header-logo" href="#">
            <img src="https://tmu.edu.vn/html/images/logo.png" alt class="img-fluid logo-head" style="height: 60px;">
          </a>
        </div>

        <!-- Giữa: Tìm kiếm -->
        <div class="header-center">
          <form action="index.php" method="get" class="search-form">
            <input type="hidden" name="page" value="search">
            <input type="text" name="query" class="search-input" placeholder="Tìm kiếm..." required>
            <button type="submit" class="search-button">🔍</button>
          </form>
        </div>

        <!-- Bên phải: Mạng xã hội -->
        <div class="header-right header-social">
          <a href="https://www.facebook.com/thuongmaiuniversity/" target="_blank">
            <img src="https://tmu.edu.vn/template_dhtm/images/ic-fb.png" alt="FB" height="24">
          </a>
          <a href="https://www.youtube.com/channel/UC9-NJM8V8oXewEIfPHica_Q" target="_blank">
            <img src="https://tmu.edu.vn/template_dhtm/images/ic-ytb.png" alt="YT" height="24">
          </a>
          <a href="https://www.facebook.com/thuongmaiuniversity/" target="_blank">
            <img src="https://tmu.edu.vn/template_dhtm/images/ic-mess.png" alt="MES" height="24">
          </a>
          <a href="#" target="_blank">
            <img src="https://tmu.edu.vn/template_dhtm/images/ic-in.png" alt="IN" height="24">
          </a>
        </div>
      </div>
    </div>

    <!-- MENU -->
    <nav class="main-nav">
      <ul class="menu">
        <li><a href="index.php" class="<?= $page === 'home' ? 'active' : '' ?>">TRANG CHỦ</a></li>
        <li><a href="index.php?page=tuyensinh" class="<?= $page === 'tuyensinh' ? 'active' : '' ?>">TUYỂN SINH</a></li>
        <li><a href="index.php?page=nganh" class="<?= $page === 'nganh' ? 'active' : '' ?>">THÔNG TIN NGÀNH HỌC</a></li>
        <li><a href="index.php?page=sinhvien" class="<?= $page === 'sinhvien' ? 'active' : '' ?>">SINH VIÊN TMU</a></li>
        <li><a href="index.php?page=lienhe" class="<?= $page === 'lienhe' ? 'active' : '' ?>">LIÊN HỆ</a></li>

        <!-- ✅ Mục đăng nhập admin -->
        <?php if (!isset($_SESSION['admin'])): ?>
          <li style="float: right;">
            <a href="login.php" title="Đăng nhập quản trị">
              <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Login" height="20">
            </a>
          </li>
        <?php else: ?>
          <li style="float: right; position: relative;">
            <div class="admin-toggle" style="display: flex; align-items: center;">
              <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Admin" height="20" title="Đã đăng nhập">
              <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="✓" height="20" title="Đã đăng nhập" style="margin-left: -8px; margin-top: -8px; position: absolute;">
              <button id="adminMenuBtn" style="font-size: 30px; background: none; border: none;">☰</button>
            </div>
            <!-- Dropdown -->
            <div id="adminMenuDropdown" class="dropdown-content">
              <a href="index.php" style="color: orange; font-weight: bold;">TRANG THÔNG TIN</a>
              <a href="admin/index.php"> TRANG QUẢN TRỊ VIÊN</a>
              <a href="logout.php"> ĐĂNG XUẤT</a>
            </div>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('adminMenuBtn');
    const dropdown = document.getElementById('adminMenuDropdown');

    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', function () {
      dropdown.style.display = 'none';
    });
  });
</script>

<style>
.admin-toggle {
  display: flex;
  align-items: center;
  gap: 20px;
  position: relative;
}
.admin-toggle img.admin-icon {
  height: 30px;
}
.admin-toggle img.tick-icon {
  height: 18px;
  position: absolute;
  top: -5px;
  left: 20px;
}
.dropdown-content {
  position: absolute;
  top: 11px;
  left: 110%;
  background-color: #fff;
  min-width: 200px;
  box-shadow: 0 8px 16px rgba(0,0,0,0.2);
  z-index: 1000;
  display: none;
  border-radius: 5px;
}
.dropdown-content a {
  padding: 12px 16px;
  display: block;
  text-decoration: none;
  color: #333;
  white-space: nowrap;
}
.dropdown-content a:hover {
  background-color: #f1f1f1;
}
#adminMenuBtn {
  font-size: 30px;
  background: none;
  border: none;
  cursor: pointer;
  color: white;
  font-weight: bold;
}
.header-top-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
  width: 100%;
}
.header-container {
  max-width: 100%;
  padding: 0 30px;
}
.header-left,
.header-right {
  width: 20%;
  display: flex;
  align-items: center;
}

.header-left {
  justify-content: flex-start;
}
.header-right {
  justify-content: flex-end;
  gap: 12px;
}

.header-center {
  width: 60%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.search-form {
  display: flex;
  width: 100%;
  max-width: 500px;
}

.search-input {
  flex: 1;
  padding: 10px 16px;
  border-radius: 30px 0 0 30px;
  border: none;
  background-color: rgba(255, 255, 255, 0.6);
  font-size: 16px;
  font-family: 'Roboto', sans-serif;
  outline: none;
  transition: background-color 0.3s;
}

.search-input::placeholder {
  color: #555;
  font-style: italic;
}

.search-button {
  background-color: orange;
  border: none;
  padding: 0 18px;
  border-radius: 0 30px 30px 0;
  cursor: pointer;
  font-size: 20px;
  color: white;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background-color 0.3s;
}

.search-button:hover {
  background-color: darkorange;
}
</style>
