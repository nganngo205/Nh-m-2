<?php
session_start();
$admin_id = $_SESSION['admin_id'] ?? null;

include_once __DIR__ . '/../../../config/db.php';

// Kiểm tra nếu chưa đăng nhập
if (!$admin_id) {
    die("Bạn cần đăng nhập để sửa ngành đào tạo.");
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ.");
}

$id = intval($_GET['id']);

// Lấy dữ liệu ngành hiện tại
$stmt = $conn->prepare("SELECT * FROM training_major WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) {
    die("Không tìm thấy ngành.");
}

// Lấy danh sách chương trình đào tạo
$programs = $conn->query("SELECT id, name FROM trainingprograms");

// Xử lý cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $quota = (int)$_POST['quota'];
    $trainingprogram_id = $_POST['trainingprogram_id'];

    $stmt = $conn->prepare("UPDATE training_major SET code = ?, name = ?, quota = ?, trainingprogram_id = ?, admin_id = ? WHERE id = ?");
    $stmt->bind_param("ssiiii", $code, $name, $quota, $trainingprogram_id, $admin_id, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../../index.php?manage=nganh");
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
    max-width: 900px;
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
  input[type="number"],
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

<h2>Sửa ngành đào tạo</h2>
<div class="form-frame">
  <form method="post">
    <label for="code">Mã ngành:</label>
    <input type="text" name="code" id="code" value="<?= htmlspecialchars($row['code']) ?>" required>

    <label for="name">Tên ngành:</label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($row['name']) ?>" required>

    <label for="quota">Chỉ tiêu tuyển sinh:</label>
    <input type="number" name="quota" id="quota" value="<?= htmlspecialchars($row['quota']) ?>" min="0" required>

    <label for="trainingprogram_id">Chương trình đào tạo:</label>
    <select name="trainingprogram_id" id="trainingprogram_id" required>
      <?php while ($program = $programs->fetch_assoc()): ?>
        <option value="<?= $program['id'] ?>" <?= $program['id'] == $row['trainingprogram_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($program['name']) ?>
        </option>
      <?php endwhile; ?>
    </select>

    <button type="submit">Cập nhật</button>
  </form>

  <a href="../../index.php?manage=nganh" class="back-link">← Quay lại danh sách ngành</a>
</div>
