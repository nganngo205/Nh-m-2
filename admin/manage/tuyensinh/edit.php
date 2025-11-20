<?php
session_start();
$admin_id = $_SESSION['admin_id'] ?? null;
include_once __DIR__ . '/../../../config/db.php';

// Kiểm tra id hợp lệ
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID không hợp lệ.");
}

$id = intval($_GET['id']);

// Lấy dữ liệu hiện tại
$stmt = $conn->prepare("SELECT * FROM admission WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if (!$row) die("Không tìm thấy bản ghi.");

// Xử lý cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content']; // Summernote trả về HTML
    $image_url = $row['image_url'];
    $file_url = $row['file_url'];

    // Xử lý ảnh mới
    if (!empty($_FILES['image']['name'])) {
        $upload_dir = __DIR__ . '/../../../assets/images/';
        $filename = time() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            if (!empty($image_url) && file_exists(__DIR__ . '/../../../' . $image_url)) {
                unlink(__DIR__ . '/../../../' . $image_url);
            }
            $image_url = 'assets/images/' . $filename;
        }
    }

    // Xử lý file đính kèm mới
    if (!empty($_FILES['file']['name'])) {
        $upload_dir = __DIR__ . '/../../../assets/files/';
        $filename = time() . '_' . basename($_FILES['file']['name']);
        $target_file = $upload_dir . $filename;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            if (!empty($file_url) && file_exists(__DIR__ . '/../../../' . $file_url)) {
                unlink(__DIR__ . '/../../../' . $file_url);
            }
            $file_url = 'assets/files/' . $filename;
        }
    }

    // Cập nhật database
    $stmt = $conn->prepare("UPDATE admission SET title=?, image_url=?, file_url=?, content=?, admin_id=? WHERE id=?");
    $stmt->bind_param("ssssii", $title, $image_url, $file_url, $content, $admin_id, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ../../index.php?manage=tuyensinh");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin tuyển sinh</title>

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <style>
        body { font-family: Arial, sans-serif; background: #eef3f8; margin:0; padding:40px 15px; display:flex; justify-content:center; }
        .form-frame { width:100%; max-width:900px; background:#fff; border-radius:14px; padding:40px 50px; box-shadow:0 10px 25px rgba(0,0,0,0.08); }
        h2 { text-align:center; color:#003366; font-size:28px; margin-bottom:35px; }
        input[type="text"], input[type="file"] { width:100%; padding:14px 16px; font-size:15px; border:1px solid #ccc; border-radius:8px; margin-bottom:25px; background:#fdfdfd; }
        img { margin-top:5px; max-height:100px; border-radius:6px; }
        .back-container { text-align:center; margin-top:25px; }
        .back-container a { color:#2ecc71; padding:8px 16px; border:1px solid #2ecc71; border-radius:6px; text-decoration:none; }
        .back-container a:hover { background:#2ecc71; color:white; }
        button { background:#007acc; color:white; padding:14px 30px; border-radius:10px; border:none; font-weight:bold; cursor:pointer; font-size:16px; display:block; margin:auto; margin-top:20px; }
        button:hover { background:#005b99; }
    </style>
</head>
<body>

<div class="form-frame">
    <h2>Sửa thông tin tuyển sinh</h2>

    <form method="post" enctype="multipart/form-data">
        <label>Tiêu đề:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>

        <label>Hình ảnh hiện tại:</label>
        <?php if ($row['image_url']): ?>
            <img src="/Quangba_TMU/<?= htmlspecialchars($row['image_url']) ?>" alt="Hình ảnh hiện tại">
        <?php endif; ?>
        <input type="file" name="image">

        <label>File đính kèm hiện tại:</label>
        <?php if ($row['file_url']): ?>
            <a href="/Quangba_TMU/<?= htmlspecialchars($row['file_url']) ?>" target="_blank">📄 Xem file hiện tại</a>
        <?php endif; ?>
        <input type="file" name="file">

        <label>Nội dung bài viết:</label>
        <!-- Bỏ htmlspecialchars để Summernote nhận HTML đúng -->
        <textarea id="editor" name="content"><?= $row['content'] ?></textarea>

        <button type="submit">Cập nhật</button>
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
