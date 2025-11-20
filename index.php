<?php include 'includes/header.php'; ?>
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pagePath = "pages/$page.php";
if (file_exists($pagePath)) {
    include $pagePath;
} else {
    echo "<p>Trang không tồn tại!</p>";
}
?>

<?php include 'includes/footer.php'; ?>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const currentUrl = window.location.href;
    const links = document.querySelectorAll(".main-nav a");

    links.forEach(link => {
      const href = link.getAttribute("href");

      // So sánh chính xác đường dẫn (bỏ domain)
      if (currentUrl.includes(href)) {
        // Bỏ active ở tất cả link trước khi gán lại
        links.forEach(l => l.classList.remove("active"));
        link.classList.add("active");
      }
    });
  });
</script>