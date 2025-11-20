<?php
session_start();

// Hủy toàn bộ session
session_unset();
session_destroy();

// Quay về trang chủ giao diện người dùng
header("Location: index.php");
exit;
?>