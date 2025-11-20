<?php
session_start();
include(__DIR__ . '/config/db.php');

// Tạo CSRF token nếu chưa có
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();
    $_SESSION['admin'] = true;
    $_SESSION['admin_id'] = $admin['id']; // 💥 Gán admin_id vào session
    header("Location:index.php");
    exit;
}
 else {
        $error = "Sai tài khoản hoặc mật khẩu.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng nhập Quản trị viên</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: url('assets/image/slider1.webp') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.9); /* Làm nền trắng hơi trong suốt */
      
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: 500;
    }

    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    button {
      width: 100%;
      padding: 10px 12px;
      background-color:rgb(0, 97, 182);
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 20px;
      cursor: pointer;
    }

    button:hover {
      background-color: #004b93;
    }

    .error-message {
      color: red;
      margin-bottom: 10px;
      text-align: center;
    }

    .tmu-logo {
      text-align: center;
      margin-bottom: 15px;
    }

    .tmu-logo img {
      width: 250px;
      margin: center;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="tmu-logo">
      <img src="https://tmu.edu.vn/html/images/logo.png" alt="TMU Logo">
    </div>
    <h2>Đăng nhập Quản trị viên!</h2>
    
    <?php if (!empty($error)): ?>
      <div class="error-message"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

      <label for="username">Tên đăng nhập:</label>
      <input type="text" id="username" name="username" placeholder="Tên đăng nhập" required>

      <label for="password">Mật khẩu:</label>
      <input type="password" id="password" name="password" placeholder="Mật khẩu" required>

      <button type="submit">Đăng nhập</button>
    </form>
  </div>
</body>
</html>
