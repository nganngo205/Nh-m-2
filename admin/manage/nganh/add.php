<?php
session_start();
$admin_id = $_SESSION['admin_id'] ?? null;

include __DIR__ . '/../../../config/db.php';

// Kiểm tra nếu chưa đăng nhập
if (!$admin_id) {
    die("Bạn cần đăng nhập để thêm ngành đào tạo.");
}

// Xử lý form khi gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $quota = (int)$_POST['quota'];
    $program_id = $_POST['trainingprogram_id'];

    $stmt = $conn->prepare("INSERT INTO training_major (code, name, quota, trainingprogram_id, admin_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $code, $name, $quota, $program_id, $admin_id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../../index.php?manage=nganh"); // Quay lại danh sách
    exit;
}

// Lấy danh sách chương trình đào tạo
$programs = $conn->query("SELECT id, name FROM trainingprograms");
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
  input[type="number"],
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

<h2>Thêm ngành đào tạo</h2>
<div class="form-wrapper">
  <form method="post">
    <label for="code">Mã ngành:</label>
    <input type="text" name="code" id="code" required>

    <label for="name">Tên ngành:</label>
    <input type="text" name="name" id="name" required>

    <label for="quota">Chỉ tiêu tuyển sinh:</label>
    <input type="number" name="quota" id="quota" required min="0">

    <label for="trainingprogram_id">Chương trình đào tạo:</label>
    <select name="trainingprogram_id" id="trainingprogram_id" required>
      <option value="">-- Chọn chương trình --</option>
      <?php while ($row = $programs->fetch_assoc()): ?>
        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
      <?php endwhile; ?>
    </select>

    <button type="submit">Lưu ngành</button>
  </form>

  <a href="../../index.php?manage=nganh" class="back-link">← Quay lại danh sách ngành</a>
</div>
