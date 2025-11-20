<?php
include_once __DIR__ . '/../../../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Lấy đường dẫn file để xóa
    $stmt = $conn->prepare("SELECT image_url, file_url FROM admission WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($image_url, $file_url);
    $stmt->fetch();
    $stmt->close();

    // Xóa file ảnh
    if (!empty($image_url)) {
        $image_path = __DIR__ . '/../../../' . $image_url;
        if (file_exists($image_path)) unlink($image_path);
    }

    // Xóa file đính kèm
    if (!empty($file_url)) {
        $file_path = __DIR__ . '/../../../' . $file_url;
        if (file_exists($file_path)) unlink($file_path);
    }

    // Xóa record DB
    $conn->query("DELETE FROM admission WHERE id = $id");
}

header("Location: restore.php");
exit;
