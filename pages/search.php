<?php
require_once __DIR__ . '/../config/db.php';

$query = isset($_GET['query']) ? trim($_GET['query']) : '';
$safeQuery = htmlspecialchars($query);

// Tạo ánh xạ trainingprogram_id => name
$program_names = [];
$prog_result = $conn->query("SELECT id, name FROM trainingprograms");
while ($p = $prog_result->fetch_assoc()) {
    $program_names[$p['id']] = $p['name'];
}
?>

<div class="container" style="padding: 60px;">
  <h2>Kết quả tìm kiếm cho: <em><?= $safeQuery ?></em></h2>

  <div class="search-results">

<?php if ($query === ''): ?>
  <p>⚠️ Bạn chưa nhập từ khóa tìm kiếm.</p>
<?php else: ?>

  <?php
    $param = "%$query%";
    $results = [];

    // 1️⃣ Tìm trong bảng training_major (ngành đào tạo)
    $sql1 = "SELECT id, name, subject_combinations_2025, trainingprogram_id FROM training_major
             WHERE name LIKE ? OR subject_combinations_2025 LIKE ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("ss", $param, $param);
    $stmt1->execute();
    $rs1 = $stmt1->get_result();
    while ($m = $rs1->fetch_assoc()) {
        $program_name = $program_names[$m['trainingprogram_id']] ?? 'Chương trình khác';
        $excerpt = "Tổ hợp: " . $m['subject_combinations_2025'] . " | Chương trình: " . $program_name;

        $results[] = [
            'title' => $m['name'] . " (" . $program_name . ")",
            'excerpt' => $excerpt,
            'url' => "index.php?page=nganh&id=" . $m['id'] . "#result-" . $m['id']
        ];
    }

    // 2️⃣ Tìm trong bảng admission
    $sql2 = "SELECT id, title, content FROM admission
             WHERE title LIKE ? OR content LIKE ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("ss", $param, $param);
    $stmt2->execute();
    $rs2 = $stmt2->get_result();
    while ($n = $rs2->fetch_assoc()) {
        $results[] = [
            'title' => $n['title'],
            'excerpt' => strip_tags(substr($n['content'], 0, 200)),
            'url' => "index.php?page=tuyensinh&id=" . $n['id'] . "#result-" . $n['id']
        ];
    }

    // 3️⃣ Tìm trong bảng student_groups
    $sql3 = "SELECT id, name, category FROM student_groups
             WHERE name LIKE ? OR category LIKE ?";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("ss", $param, $param);
    $stmt3->execute();
    $rs3 = $stmt3->get_result();
    while ($g = $rs3->fetch_assoc()) {
        $results[] = [
            'title' => $g['name'] . " (" . $g['category'] . ")",
            'excerpt' => "Thuộc nhóm: " . $g['category'],
            'url' => "index.php?page=sinhvien&id=" . $g['id'] . "#result-" . $g['id']
        ];
    }

    // 4️⃣ Tìm trong bảng departments
    $sql4 = "SELECT id, name FROM departments WHERE name LIKE ?";
    $stmt4 = $conn->prepare($sql4);
    $stmt4->bind_param("s", $param);
    $stmt4->execute();
    $rs4 = $stmt4->get_result();
    while ($d = $rs4->fetch_assoc()) {
        $results[] = [
            'title' => "Khoa/Viện: " . $d['name'],
            'excerpt' => "Tên Khoa/Viện trùng khớp: " . $d['name'],
            'url' => "index.php?page=department&highlight=" . $d['id']
        ];
    }

    // 🔍 Hiển thị kết quả
    if (count($results) === 0): ?>
      <p>Không tìm thấy kết quả phù hợp cho "<strong><?= $safeQuery ?></strong>".</p>
    <?php else:
      foreach ($results as $res):
        $highlighted = preg_replace("/(" . preg_quote($query, '/') . ")/i",
                                    "<strong style='color:orange;'>$1</strong>",
                                    htmlspecialchars($res['excerpt']));
    ?>
      <div style="margin-bottom: 20px; padding: 10px; border: 1px solid #eee; border-radius: 6px;">
        <h4 style="margin: 0;">
          🔗 <a href="<?= htmlspecialchars($res['url']) ?>"
               style="text-decoration: none; color: #0077cc;">
            <?= htmlspecialchars($res['title']) ?>
          </a>
        </h4>
        <p style="margin: 5px 0 0;"><?= $highlighted ?></p>
      </div>
    <?php endforeach;
    endif;
  ?>

<?php endif; ?>

  </div>
</div>

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
