<?php
include_once __DIR__ . '/../../../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Soft delete: Không xóa ảnh, không xóa file, chỉ đánh dấu đã xóa
    $stmt = $conn->prepare("UPDATE admission SET deleted_at = NOW() WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Sau khi xóa => chuyển sang trang khôi phục
header("Location: restore.php");
exit;
