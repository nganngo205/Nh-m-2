<?php
include __DIR__ . '/../../config/db.php';

// Lấy thông tin liên hệ và tên chương trình đào tạo từ bảng trainingprograms
$result = $conn->query("
    SELECT cf.*, tp.name AS program_name 
    FROM contact_form cf
    LEFT JOIN trainingprograms tp ON cf.trainingprogram_id = tp.id
    ORDER BY cf.created_at DESC
");
?>

<h1 style="padding: 0 30px; font-size: 20px; color: orange">TRANG QUẢN LÝ >> Quản lý liên hệ</h1>
<h2 style="margin-bottom: 20px;">Danh sách thông tin liên hệ của người gửi</h2>

<style>
.content-wrapper {
  padding: 0 30px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin: 0 auto;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  border-radius: 8px;
  overflow: hidden;
}

th, td {
  padding: 12px 16px;
  text-align: left;
  vertical-align: top;
  word-wrap: break-word;
  max-width: 200px;
}

th {
  background-color: #f0f0f0;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f9f9f9;
}

table, th, td {
  border: 1px solid #ccc;
}

h2 {
  text-align: center;
  color: #333;
}
</style>

<div class="content-wrapper">
  <table>
    <tr>
      <th>Họ tên</th>
      <th>Điện thoại</th>
      <th>Email</th>
      <th>Facebook</th>
      <th>Chương trình</th>
      <th>Câu hỏi</th>
      <th>Thời gian</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['fullname']) ?></td>
      <td><?= htmlspecialchars($row['phone']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['facebook_link']) ?></td>
      <td><?= htmlspecialchars($row['program_name']) ?></td>
      <td><?= nl2br(htmlspecialchars($row['question'])) ?></td>
      <td><?= htmlspecialchars($row['created_at']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
