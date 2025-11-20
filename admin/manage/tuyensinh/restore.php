<?php
include_once __DIR__ . '/../../../config/db.php';
$baseUrl = '/Quangba_TMU/';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Lịch sử bài viết tuyển sinh</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      color: #333;
    }

    .content-wrapper {
      padding: 0 30px 30px 30px;
    }

    h1 {
      font-size: 20px;
      color: orange;
      padding: 15px 0;
      text-align: left;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    table, th, td {
      border: 1px solid #333;
    }

    th {
      background-color: #d1d1d1;
      padding: 12px 10px;
      text-align: left;
    }

    td {
      background-color: #fdf9f9;
      padding: 10px;
      vertical-align: top;
    }

    tr:hover td {
      background-color: #f0f0f0;
    }

    img {
      height: 70px;
      width: auto;
      margin: 5px 0;
    }

    /* Nút */
    a.button {
      display: inline-block;
      padding: 8px 14px;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 2px;
      font-size: 14px;
      text-align: center;
    }

    /* Màu nút */
    .btn-back { background-color: #2ecc71; }
    .btn-restore { background-color: #f39c12; }
    .btn-delete { background-color: #e74c3c; }

    /* Hover */
    .btn-back:hover { background-color: #7f8c8d; }
    .btn-restore:hover { background-color: #d35400; }
    .btn-delete:hover { background-color: #c0392b; }

    /* Cột nội dung dài */
    .content-preview {
      max-width: 400px;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }

    /* File đính kèm */
    .file-link {
      display: inline-block;
      font-size: 14px;
    }

    /* Nút quay lại dưới bảng */
    .back-container {
      text-align: center;
      margin-top: 20px;
    }
  </style>
</head>
<body>

<h1>Quản lý bài viết tuyển sinh >> Lịch sử</h1>
<h2>Danh sách bài viết đã xóa</h2>

<div class="content-wrapper">

  <table>
    <tr>
      <th style="width:50px;">ID</th>
      <th>Tiêu đề</th>
      <th style="width:120px;">Hình ảnh</th>
      <th>Nội dung</th>
      <th style="width:150px;">File đính kèm</th>
      <th style="width:220px;">Hành động</th>
      <th style="width:150px;">Ngày xóa</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM admission WHERE deleted_at IS NOT NULL ORDER BY deleted_at DESC");
    while($row = $result->fetch_assoc()):
    ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= htmlspecialchars($row['title']) ?></td>

      <td>
        <?php if (!empty($row['image_url'])): ?>
          <img src="<?= $baseUrl.htmlspecialchars($row['image_url']) ?>" alt="Ảnh minh họa">
        <?php else: ?>
          Không có ảnh
        <?php endif; ?>
      </td>

      <td class="content-preview"><?= nl2br(htmlspecialchars(substr($row['content'],0,300))) ?>...</td>

      <td>
        <?php if (!empty($row['file_url'])): ?>
          <a href="<?= $baseUrl.htmlspecialchars($row['file_url']) ?>" target="_blank" download class="file-link">📄 Tải file</a>
        <?php else: ?>
          Không có file
        <?php endif; ?>
      </td>

      <td>
        <a href="restore_action.php?id=<?= $row['id'] ?>" class="button btn-restore">Khôi phục</a>
        <a href="delete_forever.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn muốn xóa VĨNH VIỄN? Không thể hoàn tác!')" class="button btn-delete">Xóa vĩnh viễn</a>
      </td>

      <td><?= $row['deleted_at'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>

  <!-- Nút quay lại danh sách dưới bảng -->
  <div class="back-container">
    <a href="../../index.php?manage=tuyensinh" class="button btn-back">⬅ Quay về danh sách</a>
  </div>

</div>

</body>
</html>
