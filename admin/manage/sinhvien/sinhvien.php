<?php 
include_once __DIR__ . '/../../../config/db.php'; 
$baseUrl = '/Quangba_TMU/';
?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<style>
  .content-wrapper {
    padding: 0 30px;
  }
  h2 {
    text-align: center;
    color: #333;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
  }
  table, th, td {
    border: 1px solid #ccc;
  }
  th {
    background-color: rgb(209, 209, 209);
  }
  td {
    background-color: rgb(253, 249, 249);
  }
  th, td {
    padding: 10px;
    text-align: left;
  }
  a.button {
    display: inline-block;
    padding: 8px 12px;
    background-color: #2ecc71;
    color: white;
    text-decoration: none;
    border-radius: 5px;
  }
  a.button:hover {
    background-color: #27ae60;
  }
</style>

<h1 style="padding: 0 30px; font-size: 20px; color: orange;">TRANG QUẢN LÝ >> Quản lý hoạt động sinh viên</h1>
<h2 style="margin-bottom: 20px;">Danh sách CLB - Đội - Nhóm Sinh viên</h2>

<div class="content-wrapper">
  <a href="../admin/manage/sinhvien/add.php" class="button">+ Thêm mới</a>

  <?php
  $categories = ['CLB', 'Đội tình nguyện', 'Nhóm'];
  foreach ($categories as $category):
    echo "<h3 style='margin-top: 30px; color: #444;'>$category</h3>";
    echo "<table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Đường dẫn</th>
                <th>Loại</th>
                <th style='width: 150px;'>Hành động</th>
              </tr>
            </thead>
            <tbody>";

    $stmt = $conn->prepare("SELECT * FROM student_groups WHERE category = ? ORDER BY id DESC");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()):
  ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><a href="<?= htmlspecialchars($row['url']) ?>" target="_blank"><?= htmlspecialchars($row['url']) ?></a></td>
        <td><?= $row['category'] ?></td>
        <td>
          <a href="../admin/manage/sinhvien/edit.php?id=<?= $row['id'] ?>" class="button">Sửa</a> |
          <a href="../admin/manage/sinhvien/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="button">Xóa</a>
        </td>
      </tr>
  <?php
    endwhile;
    echo "</tbody></table>";
    $stmt->close();
  endforeach;
  ?>
</div>
