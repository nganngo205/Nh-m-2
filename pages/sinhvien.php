<?php
include_once __DIR__ . '/../config/db.php';

// Lấy id từ URL để highlight nếu có
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Lấy toàn bộ dữ liệu nhóm sinh viên từ CSDL
$query = "SELECT id, name, url, category FROM student_groups ORDER BY category ASC, name ASC";
$result = $conn->query($query);

// Tách dữ liệu theo category
$clubs = [];
$teams = [];
$groups = [];

while ($row = $result->fetch_assoc()) {
    switch ($row['category']) {
        case 'CLB':
            $clubs[] = $row;
            break;
        case 'Đội tình nguyện':
            $teams[] = $row;
            break;
        case 'Nhóm':
            $groups[] = $row;
            break;
    }
}
?>

<style>
.section-title {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #444;
    margin: 0 auto 10px auto;
    text-transform: uppercase;
    position: relative;
    display: block;
    width: fit-content;
}

.section-title::after {
    content: "";
    display: block;
    height: 4px;
    width: 90px;
    background-color: #444;
    margin: 8px auto 0 auto;
    border-radius: 2px;
}

.content {
    margin: 20px auto;
}

.faculty-columns {
    display: flex;
    gap: 30px;
    max-width: 1200px;
    margin: auto;
}

.column {
    flex: 1;
}

.column a {
    display: block;
    font-size: 16px;
    color: #000;
    text-decoration: none;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 6px;
    transition: color 0.2s;
}

.column a:hover {
    color: #007BFF;
}
</style>

<section class="slider">
    <div class="slides">
        <div class="slide active"><img src="assets/image/tour1.jpg" alt=""></div>
        <div class="slide"><img src="assets/image/ted.jpg" alt=""></div>
        <div class="slide"><img src="assets/image/seaofhope.jpg" alt=""></div>
        <div class="slide"><img src="assets/image/chaotan.jpg" alt=""></div>
        <div class="slide"><img src="assets/image/ted1.jpg" alt=""></div>
    </div>
    <button class="prev">&#10094;</button>
    <button class="next">&#10095;</button>
</section>

<section class="content">
    <h3 class="section-title">CLB - ĐỘI - NHÓM</h3>
    <div class="faculty-columns">

        <!-- Cột CLB -->
        <div class="column">
            <?php foreach ($clubs as $club): ?>
                <div id="result-<?= $club['id'] ?>" style="<?= $id === intval($club['id']) ? 'background-color: #ffe8cc;' : '' ?>">
                    <a href="<?= htmlspecialchars($club['url']) ?>" target="_blank">
                        <?= htmlspecialchars($club['name']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cột Đội tình nguyện -->
        <div class="column">
            <?php foreach ($teams as $team): ?>
                <div id="result-<?= $team['id'] ?>" style="<?= $id === intval($team['id']) ? 'background-color: #ffe8cc;' : '' ?>">
                    <a href="<?= htmlspecialchars($team['url']) ?>" target="_blank">
                        <?= htmlspecialchars($team['name']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cột Nhóm -->
        <div class="column">
            <?php foreach ($groups as $group): ?>
                <div id="result-<?= $group['id'] ?>" style="<?= $id === intval($group['id']) ? 'background-color: #ffe8cc;' : '' ?>">
                    <a href="<?= htmlspecialchars($group['url']) ?>" target="_blank">
                        <?= htmlspecialchars($group['name']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

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
