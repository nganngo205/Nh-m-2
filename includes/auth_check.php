<?php
session_start();
if (!isset($_SESSION['admin'])) {
    // Use an absolute URL for redirection
    $redirect_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . "/login.php";
    header("Location: /login.php");
    exit();
}
?>
