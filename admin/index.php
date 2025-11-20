<?php 
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang quản trị viên</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    * { box-sizing: border-box; }

    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 280px;
      background-color: #fff;
      color: black;
      height: 100vh;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      position: fixed;
      left: 0;
      top: 0;
      padding: 20px;
      z-index: 100;
    }

    .main {
      margin-left: 280px;
      display: flex;
      flex-direction: column;
      height: 100vh;
      width: calc(100% - 280px);
    }

    .content {
      flex: 1;
      padding: 40px;
      background-color: rgb(254, 255, 255);
      border-top: 1px solid #ccc;
      overflow-y: auto;
    }

    .home-background {
      background: url('../assets/image/3-16577920384671286240724.webp') no-repeat center center;
      backdrop-filter: brightness(0.9);
      background-size: cover;
      color: #fff;
      /* Căn giữa nội dung */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .content h1 {
      font-size: 35px;
 
    }
    .welcome-box {
      background: rgba(94, 94, 94, 0.6);
      padding: 40px;
      border-radius: 10px;
      text-align: center;
      max-width: 770px;
    }

    .welcome-box h1 {
      font-size: 36px;
      margin: 0;
      color: #fff;
    }

   
  </style>
</head>
<body>

  <!-- Sidebar -->
  <?php include __DIR__ . '/includes/sidebar.php'; ?>

  <!-- Main Section -->
  <div class="main">
    <div class="header">
      <?php include __DIR__ . '/includes/header.php'; ?>
    </div>

    <?php
      $page = $_GET['manage'] ?? 'home';
      $action = $_GET['action'] ?? '';
      $isHome = $page === 'home';
    ?>
    
    <div class="content <?= $isHome ? 'home-background' : '' ?>">
      <?php
        switch ($page) {
          case 'tuyensinh':
            if ($action === 'add') {
              include __DIR__ . '/manage/tuyensinh/add.php';
            } elseif ($action === 'edit') {
              include __DIR__ . '/manage/tuyensinh/edit.php';
            } elseif ($action === 'delete') {
              include __DIR__ . '/manage/tuyensinh/delete.php';
            } else {
              include __DIR__ . '/manage/tuyensinh/tuyensinh.php';
            }
            break;

          case 'nganh':
            if ($action === 'add') {
              include __DIR__ . '/manage/nganh/add.php';
            } elseif ($action === 'edit') {
              include __DIR__ . '/manage/nganh/edit.php';
            } elseif ($action === 'delete') {
              include __DIR__ . '/manage/nganh/delete.php';
            } else {
              include __DIR__ . '/manage/nganh/nganh.php';
            }
            break;

          case 'sinhvien':
            if ($action === 'add') {
              include __DIR__ . '/manage/sinhvien/add.php';
            } elseif ($action === 'edit') {
              include __DIR__ . '/manage/sinhvien/edit.php';
            } elseif ($action === 'delete') {
              include __DIR__ . '/manage/sinhvien/delete.php';
            } else {
              include __DIR__ . '/manage/sinhvien/sinhvien.php';
            }
            break;

          case 'contact':
            $path = __DIR__ . "/manage/{$page}.php";
            if (file_exists($path)) {
              include $path;
            } else {
              echo "<p>Trang quản lý không tồn tại.</p>";
            }
            break;

          case 'home':
          default:
            echo '<div class="welcome-box"><h1>Chào mừng bạn đến với Trang quản trị viên</h1>';
        }
      ?>
    </div>
  </div>

</body>
</html>
