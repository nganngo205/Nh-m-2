<div class="nganh-wrapper">
  <h2><strong>Danh sách Ngành đào tạo theo chương trình tại TMU (2025)</strong></h2>
  <div class="nganh-grid">

    <?php
    include __DIR__ . '/../config/db.php';

    $chuong_trinh_labels = [
      'Chương trình đào tạo chuẩn' => ['I. Chương trình đào tạo chuẩn', 'assets/image/ctdtchuan.jpg'],
      'Chương trình định hướng chuyên sâu và nghiệp vụ quốc tế - IPOP' => ['II. Chương trình định hướng chuyên sâu và nghiệp vụ quốc tế - IPOP', 'assets/image/ctct-ipop.jpg'],
      'Chương trình đào tạo song bằng quốc tế' => ['III. Chương trình đào tạo song bằng quốc tế', 'assets/image/ctdtsongbang.jpg'],
      'Chương trình đào tạo tiên tiến' => ['IV. Chương trình đào tạo tiên tiến', 'assets/image/ctdttientien.jpg'],
    ];

    $programs = $conn->query("SELECT id, name FROM trainingprograms");

    while ($program = $programs->fetch_assoc()) {
      $program_id = $program['id'];
      $program_name = trim($program['name']);
      [$title, $image] = $chuong_trinh_labels[$program_name] ?? ['Chương trình khác', 'assets/image/default.jpg'];

      $stmt = $conn->prepare("SELECT id, code, name, quota, admission_methods_2025, subject_combinations_2025 FROM training_major WHERE trainingprogram_id = ? ORDER BY id ASC");
      $stmt->bind_param("i", $program_id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0):
    ?>
    <details>
      <summary>
        <img src="<?= $image ?>" alt="<?= htmlspecialchars($title) ?>">
        <strong><?= htmlspecialchars($title) ?></strong>
      </summary>
      <table>
        <thead>
          <tr>
            <th>Mã tuyển sinh</th>
            <th>Tên ngành</th>
            <th>Chỉ tiêu</th>
            <th>Phương thức 2025</th>
            <th>Tổ hợp môn 2025</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr id="result-<?= $row['id'] ?>">
              <td><?= htmlspecialchars($row['code']) ?></td>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['quota']) ?></td>
              <td><?= nl2br(htmlspecialchars($row['admission_methods_2025'])) ?></td>
              <td><?= nl2br(htmlspecialchars($row['subject_combinations_2025'])) ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </details>
    <?php
      endif;
      $stmt->close();
    }
    ?>
  </div>
</div>

<style>
body {
  margin: 0;
  font-family: Arial, sans-serif;
  background-color: #f0f0f0;
}

.nganh-wrapper {
  max-width: 1500px;
  margin: 0 auto;
  padding: 50px 30px;
  text-align: center;
}

.nganh-wrapper h2 {
  font-size: 32px;
  margin-bottom: 40px;
  color: #003366;
}

.nganh-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  justify-content: center;
}

.nganh-grid details {
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  padding: 20px;
  width: 100%;
  max-width: 670px;
  flex: 1 1 calc(50% - 40px);
  box-sizing: border-box;
  text-align: center;
}

.nganh-grid summary {
  display: flex;
  flex-direction: column;
  align-items: center;
  list-style: none;
  cursor: pointer;
  gap: 15px;
}

.nganh-grid summary::-webkit-details-marker {
  display: none;
}

.nganh-grid summary img {
  width: 100%;
  height: auto;
  border-radius: 10px;
  object-fit: cover;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  max-height: 500px;
}

.nganh-grid summary strong {
  font-size: 20px;
  color: #00509e;
}

.nganh-grid table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 15px;
}

.nganh-grid th,
.nganh-grid td {
  border: 1px solid #ddd;
  padding: 8px;
  font-size: 14px;
  text-align: left;
  vertical-align: top;
}

.nganh-grid thead {
  background-color: #e8f0fa;
  font-weight: bold;
}

.nganh-grid details[open] summary {
  margin-bottom: 10px;
}

.nganh-grid summary strong::before {
  content: "\25BA  ";
  font-weight: bold;
  color: #007bff;
  font-size: 22px;
}

@media (max-width: 768px) {
  .nganh-grid {
    flex-direction: column;
  }

  .nganh-grid details {
    max-width: 100%;
  }
}
</style>

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
