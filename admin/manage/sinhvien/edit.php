<?php
session_start();
$admin_id = $_SESSION['admin_id'] ?? null;

include_once __DIR__ . '/../../../config/db.php';

if (!$admin_id) {
    die("Bạn cần đăng nhập để sửa thông tin nhóm.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ.");
}

$id = intval($_GET['id']);

// Lấy dữ liệu nhóm sinh viên hiện tại
$stmt = $conn->prepare("SELECT * FROM student_groups WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    die("Không tìm thấy nhóm sinh viên.");
}

// Xử lý cập nhật khi form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $url = $_POST['url'];
    $category = $_POST['category'];

    $stmt = $conn->prepare("UPDATE student_groups SET name = ?, url = ?, category = ?, admin_id = ? WHERE id = ?");
    $stmt->bind_param("sssii", $name, $url, $category, $admin_id, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../../index.php?manage=sinhvien");
    exit;
}
?>

<style>
  body {
    font-family: 'Roboto', sans-serif;
    background-color: #eef3f8;
    padding: 40px 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  h2 {
    color: #003366;
    font-size: 30px;
    font-weight: 700;
    margin-bottom: 30px;
  }

  .form-frame {
    background: #fff;
    max-width: 800px;
    width: 100%;
    border-radius: 12px;
    padding: 40px 50px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  }

  label {
    font-weight: bold;
    margin-top: 20px;
    display: block;
  }

  input[type="text"],
  select {
    width: 100%;
    padding: 14px;
    margin-top: 8px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    background-color: #fdfdfd;
  }

  button {
    margin-top: 25px;
    background-color: #007acc;
    color: white;
    padding: 14px 30px;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
  }

  button:hover {
    background-color: #005b99;
  }

  a.back-link {
    display: block;
    text-align: right;
    margin-top: 20px;
    color: #6b46c1;
    font-size: 15px;
    text-decoration: none;
  }

  a.back-link:hover {
    text-decoration: underline;
  }
</style>

<h2>Sửa nhóm sinh viên</h2>
<div class="form-frame">
  <form method="post">
    <label for="name">Tên nhóm:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($row['name']) ?>" required>

    <label for="url">Liên kết Facebook / Website:</label>
    <input type="text" name="url" id="url" value="<?= htmlspecialchars($row['url']) ?>" required>

    <label for="category">Phân loại:</label>
    <select name="category" id="category" required>
      <option value="">-- Chọn loại nhóm --</option>
      <option value="CLB" <?= $row['category'] === 'CLB' ? 'selected' : '' ?>>CLB</option>
      <option value="Đội tình nguyện" <?= $row['category'] === 'Đội tình nguyện' ? 'selected' : '' ?>>Đội tình nguyện</option>
      <option value="Nhóm" <?= $row['category'] === 'Nhóm' ? 'selected' : '' ?>>Nhóm</option>
    </select>

    <button type="submit">Cập nhật nhóm</button>
  </form>

  <a href="../../index.php?manage=sinhvien" class="back-link">← Quay lại danh sách nhóm</a>
</div>
