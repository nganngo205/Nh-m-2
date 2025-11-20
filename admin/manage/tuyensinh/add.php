<?php
session_start();
include __DIR__ . '/../../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content']; // Summernote trả về HTML
    $image_url = '';
    $file_url = '';
    $admin_id = $_SESSION['admin_id'] ?? null;

    // Xử lý ảnh
    if (!empty($_FILES['image']['name'])) {
        $upload_dir_img = __DIR__ . '/../../../assets/images/';
        if (!file_exists($upload_dir_img)) mkdir($upload_dir_img, 0777, true);

        $filename_img = time() . '_' . basename($_FILES['image']['name']);
        $target_img = $upload_dir_img . $filename_img;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_img)) {
            $image_url = 'assets/images/' . $filename_img;
        }
    }

    // Xử lý file đính kèm
    if (!empty($_FILES['file']['name'])) {
        $upload_dir_file = __DIR__ . '/../../../assets/files/';
        if (!file_exists($upload_dir_file)) mkdir($upload_dir_file, 0777, true);

        $filename_file = time() . '_' . basename($_FILES['file']['name']);
        $target_file = $upload_dir_file . $filename_file;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            $file_url = 'assets/files/' . $filename_file;
        }
    }

    // Chèn vào CSDL
    $stmt = $conn->prepare("INSERT INTO admission (title, image_url, file_url, content, admin_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $image_url, $file_url, $content, $admin_id);
    $stmt->execute();

    header("Location: ../../index.php?manage=tuyensinh");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Thêm thông tin tuyển sinh</title>

  <!-- Summernote CSS -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

  <style>
    body { font-family: Arial, sans-serif; background-color: #eef3f8; margin: 0; padding: 40px 15px; display: flex; justify-content: center; }
    .form-frame { width: 100%; max-width: 900px; background: #fff; border-radius: 14px; padding: 40px 50px; box-shadow: 0 10px 25px rgba(0,0,0,0.08); }
    h2 { text-align: center; color: #003366; font-size: 28px; margin-bottom: 35px; }
    input[type="text"], input[type="file"], textarea { width: 100%; padding: 14px 16px; font-size: 15px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 25px; background-color: #fdfdfd; }
    textarea { min-height: 200px; }
    button { background: #007acc; color: white; padding: 14px 30px; border-radius: 10px; border: none; cursor: pointer; font-weight: bold; display: block; margin: auto; margin-top: 10px; }
    button:hover { background: #005b99; }
    .back-container { text-align: center; margin-top: 25px; }
    .back-container a { color: #2ecc71; padding: 8px 16px; border: 1px solid #2ecc71; border-radius: 6px; text-decoration: none; }
    .back-container a:hover { background: #2ecc71; color: white; }
  </style>
</head>
<body>

<div class="form-frame">
  <h2>Thêm thông tin tuyển sinh</h2>
  <form method="post" enctype="multipart/form-data">
    <label>Tiêu đề:</label>
    <input type="text" name="title" required>

    <label>Hình ảnh:</label>
    <input type="file" name="image">

    <label>File đính kèm (PDF, DOC...):</label>
    <input type="file" name="file">

    <label>Nội dung mô tả:</label>
    <textarea id="editor" name="content"></textarea>

    <button type="submit">Lưu</button>
  </form>

  <div class="back-container">
    <a href="../../index.php?manage=tuyensinh">← Quay lại danh sách</a>
  </div>
</div>

<!-- jQuery + Summernote JS -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
    $('#editor').summernote({
        height: 300,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize', 'fontname', 'color', 'backcolor']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview']]
        ]
    });
});
</script>

</body>
</html>
