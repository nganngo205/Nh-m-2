<?php
include_once __DIR__ . '/../../../config/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Xóa bản ghi nhóm sinh viên khỏi CSDL
    $stmt = $conn->prepare("DELETE FROM student_groups WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Quay lại trang danh sách nhóm sinh viên
header("Location: ../../index.php?manage=sinhvien");
exit;
