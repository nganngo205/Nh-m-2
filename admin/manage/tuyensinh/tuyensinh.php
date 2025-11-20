<?php 
include_once __DIR__ . '/../../../config/db.php';
$baseUrl = '/Quangba_TMU/'; 
?>

<style>
  .content-wrapper { padding: 0 30px; }
  h2 { text-align: center; color: #333; }
  table { width: 100%; border-collapse: collapse; margin-top: 15px; }
  table, th, td { border: 1px solid #ccc; }
  th { background-color: rgb(209, 209, 209); }
  td { background-color: rgb(253, 249, 249); }
  th, td { padding: 10px; text-align: left; }
  img { height: 70px; margin: 5px; width: auto; }

  /* Nút chung */
  a.button { display: inline-block; padding: 8px 12px; color: white; text-decoration: none; border-radius: 5px; margin: 2px; }

  /* ✅ Màu theo yêu cầu */
  .btn-add { background-color: #2ecc71; }      
  .btn-edit { background-color: #2ecc71; }     
  .btn-delete { background-color: #e67e22; }   
  .btn-restore { background-color: #e74c3c; }  

  .btn-add:hover { background-color: #27ae60; }
  .btn-edit:hover { background-color: #27ae60; }
  .btn-delete:hover { background-color: #d35400; }
  .btn-restore:hover { background-color: #c0392b; }

  /* ✅ Căn nút lịch sử sang bên phải */
  .action-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; }
</style>

<h1 style="padding: 0 30px;font-size: 20px; color: orange"> TRANG QUẢN LÝ >> Quản lý bài viết tuyển sinh</h1>
<h2 style="margin-bottom: 20px;">Danh sách bài viết tuyển sinh</h2>

<div class="content-wrapper">

  <div class="action-top">
      <a href="../admin/manage/tuyensinh/add.php" class="button btn-add">+ Thêm mới</a>
      <a href="../admin/manage/tuyensinh/restore.php" class="button btn-restore">🗂 Lịch sử</a>
  </div>

  <table>
    <tr>
      <th>ID</th>
      <th>Tiêu đề</th>
      <th>Hình ảnh</th>
      <th>Nội dung</th>
      <th style="width: 120px;">File đính kèm</th>
      <th style="width: 150px;">Hành động</th>
    </tr>

    <?php
    $result = $conn->query("SELECT * FROM admission WHERE deleted_at IS NULL ORDER BY id DESC");
    while ($row = $result->fetch_assoc()):
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

      <td>
        <?php 
        // Hiển thị HTML cơ bản, rút gọn 300 ký tự
        $content_preview = strip_tags($row['content'], '<p><br><b><i><strong><em>');
        if (strlen($content_preview) > 300) {
            $content_preview = substr($content_preview, 0, 300) . '...';
        }
        echo $content_preview;
        ?>
      </td>

      <td>
        <?php if (!empty($row['file_url'])): ?>
          📄 <a href="<?= $baseUrl.htmlspecialchars($row['file_url']) ?>" target="_blank" download>Tải file</a>
        <?php else: ?>
          Không có file
        <?php endif; ?>
      </td>

      <td>
        <a href="../admin/manage/tuyensinh/edit.php?id=<?= $row['id'] ?>" class="button btn-edit">Sửa</a>
        <a href="../admin/manage/tuyensinh/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa mục này?')" class="button btn-delete">Xóa</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
