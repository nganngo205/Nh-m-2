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

<h1 style="padding: 0 30px; font-size: 20px; color: orange;">TRANG QUẢN LÝ >> Quản lý ngành đào tạo</h1>
<h2 style="margin-bottom: 20px;">Danh sách ngành đào tạo</h2>

<div class="content-wrapper">
  <a href="../admin/manage/nganh/add.php" class="button">+ Thêm ngành mới</a>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Mã ngành</th>
        <th>Tên ngành</th>
        <th>Chỉ tiêu</th>
        <th>Chương trình đào tạo</th>
        <th style="width: 150px;">Hành động</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT tm.id, tm.code, tm.name, tm.quota, tp.name AS program_name
              FROM training_major tm
              LEFT JOIN trainingprograms tp ON tm.trainingprogram_id = tp.id
              ORDER BY tm.id DESC";
      $result = $conn->query($sql);
      while ($row = $result->fetch_assoc()):
      ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['code']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= (int)$row['quota'] ?></td>
        <td><?= htmlspecialchars($row['program_name']) ?></td>
        <td>
          <a href="../admin/manage/nganh/edit.php?id=<?= $row['id'] ?>" class="button">Sửa</a> |
          <a href="../admin/manage/nganh/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa ngành này?')" class="button">Xóa</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
