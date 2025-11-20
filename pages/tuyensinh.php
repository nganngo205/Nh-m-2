<!-- SLIDER -->
<section class="slider">
  <div class="slides">
    <div class="slide active">
      <img src="https://tmu.edu.vn/upload/banner/thumb_1920x0/banner-1740363855.jpg" alt="">
    </div>
    <div class="slide">
      <img src="https://tmu.edu.vn/upload/news/original/news-1740456438.jpg" alt="">
    </div>
    <div class="slide">
      <img src="https://tuyensinh.tmu.edu.vn/upload/news/original/news-1748857889.jpg" alt="">
    </div>
    <div class="slide">
      <img src="assets/image/465857287-873471328291782-2562-2576-9924-1740457845.webp" alt="">
    </div>
    <div class="slide">
      <img src="assets/image/SV-TMU.jpeg" alt="">
    </div>
    <div class="slide">
      <img src="assets/image/t3-1740479318264835080331.jpg" alt="">
    </div>
  </div>
  <button class="prev">&#10094;</button>
  <button class="next">&#10095;</button>
</section>

<style>
/* ==== MAIN CONTAINER ==== */
.container {
  max-width: 1100px;
  margin: 60px auto;
  padding: 0 24px;
}

/* ==== SECTION CHUNG ==== */
.tuyensinh-section {
  background-color: #fff;
  padding: 24px;
  border-radius: 10px;
  box-shadow: 3px 5px 15px rgba(16, 16, 16, 0.05);
  margin-bottom: 60px;
  transition: background-color 0.5s ease;
}

/* ==== TIÊU ĐỀ ==== */
.container h2 {
  font-size: 2rem;
  margin-bottom: 24px;
  color: #003366;
  font-weight: bold;
  text-align: center;
}

/* ==== HÌNH ẢNH ==== */
.tuyensinh-section img {
  width: 100%;
  height: auto;
  display: block;
  margin: 0 auto 20px auto;
  border-radius: 8px;
  object-fit: cover;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* ==== MÔ TẢ ==== */
.tuyensinh-section p,
.tuyensinh-section ul,
.tuyensinh-section ol {
  margin-bottom: 16px;
  text-align: justify;
}

/* ==== LINK TẢI FILE ==== */
.tuyensinh-section a,
.download-link {
  color: #0051a1;
  font-weight: bold;
  text-decoration: none;
}

.tuyensinh-section a:hover,
.download-link:hover {
  text-decoration: underline;
}
</style>

<main class="container">
  <h2>🎓 Thông tin tuyển sinh đại học Trường Đại học Thương mại</h2>

  <?php
  include_once 'config/db.php';

  // Lấy tất cả bài viết
  $result = $conn->query("SELECT * FROM admission WHERE deleted_at IS NULL ORDER BY id DESC");
  while ($row = $result->fetch_assoc()):
      // Lọc HTML an toàn
      $safe_content = strip_tags($row['content'], '<p><br><b><i><strong><em><ul><ol><li><a>');
  ?>
    <div class="tuyensinh-section" id="result-<?= $row['id'] ?>">
      <?php if (!empty($row['image_url'])): ?>
        <img src="/Quangba_TMU/<?= htmlspecialchars($row['image_url']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
      <?php endif; ?>

      <h3><?= htmlspecialchars($row['title']) ?></h3>
      <div><?= $safe_content ?></div>

      <?php if (!empty($row['file_url'])): ?>
        <p>
          📎 <a href="/Quangba_TMU/<?= htmlspecialchars($row['file_url']) ?>" class="download-link" download>
            📄 Tải thông báo chi tiết (PDF)
          </a>
        </p>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const hash = window.location.hash;
  if (hash && hash.startsWith('#result-')) {
    const target = document.querySelector(hash);
    if (target) {
      target.scrollIntoView({ behavior: 'smooth', block: 'center' });
      target.style.transition = 'background-color 0.5s ease';
      target.style.backgroundColor = '#ffe8cc';
      setTimeout(() => {
        target.style.backgroundColor = 'transparent';
      }, 3000);
    }
  }
});
</script>
