<?php
include_once __DIR__ . '/../../../config/db.php';
$id = $_GET['id'];
$conn->query("UPDATE admission SET deleted_at = NULL WHERE id = $id");
header("Location: restore.php");
exit;
