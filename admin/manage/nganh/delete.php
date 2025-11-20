<?php
include_once __DIR__ . '/../../../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Xóa bản ghi ngành đào tạo khỏi CSDL
    $stmt = $conn->prepare("DELETE FROM training_major WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Quay lại trang danh sách ngành
header("Location:../../index.php?manage=nganh");
exit;
