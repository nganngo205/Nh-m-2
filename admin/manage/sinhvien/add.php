<?php 
session_start();
$admin_id = $_SESSION['admin_id'] ?? null; // Lấy admin_id từ session

include __DIR__ . '/../../../config/db.php';

// Kiểm tra nếu admin chưa đăng nhập
if (!$admin_id) {
    die("Bạn cần đăng nhập để thêm nhóm.");
}

// Xử lý khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $category = $_POST['category'];

    // Chuẩn bị câu lệnh chèn dữ liệu
    $stmt = $conn->prepare("INSERT INTO student_groups (name, url, category, admin_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $name, $url, $category, $admin_id);
    $stmt->execute();
    $stmt->close();

    // Chuyển hướng về danh sách
    header("Location: ../../index.php?manage=sinhvien");
    exit;
}
?>

<style>
  body {
    font-family: 'Roboto', sans-serif;
    background-color: #f9f9f9;
    padding: 30px;
  }

  h2 {
    text-align: center;
    color: #333;
    margin-bottom: 30px;
  }

  .form-wrapper {
    max-width: 700px;
    margin: 0 auto;
    background: #fff;
    border-radius: 12px;
    padding: 30px 40px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
  }

  label {
    font-weight: bold;
    margin-top: 15px;
    display: block;
  }

  input[type="text"],
  select {
    width: 100%;
    padding: 12px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
  }

  button {
    margin-top: 25px;
    background-color: #28a745;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
  }

  button:hover {
    background-color: #218838;
  }

  a.back-link {
    display: block;
    text-align: right;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
  }

  a.back-link:hover {
    text-decoration: underline;
  }
</style>

<h2>Thêm nhóm sinh viên</h2>
<div class="form-wrapper">
  <form method="post">
    <label for="name">Tên nhóm:</label>
    <input type="text" name="name" id="name" required>

    <label for="url">Liên kết Facebook / Website:</label>
    <input type="text" name="url" id="url" required>

    <label for="category">Phân loại:</label>
    <select name="category" id="category" required>
      <option value="">-- Chọn loại nhóm --</option>
      <option value="CLB">CLB</option>
      <option value="Đội tình nguyện">Đội tình nguyện</option>
      <option value="Nhóm">Nhóm</option>
    </select>

    <button type="submit">Lưu nhóm</button>
  </form>

  <a href="../../index.php?manage=sinhvien" class="back-link">← Quay lại danh sách nhóm</a>
</div>
