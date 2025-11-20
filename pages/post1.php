<?php
// Kết nối CSDL
include_once __DIR__ . '/../config/db.php';

// Lấy dữ liệu ngành đào tạo
$sql = "SELECT tm.*, 
               tp.name AS program_name,
               d.name AS department_name
        FROM training_major tm
        LEFT JOIN trainingprograms tp ON tm.trainingprogram_id = tp.id
        LEFT JOIN departments d ON tm.department_id = d.id";

$result = mysqli_query($conn, $sql);
?>

<div class="container" style="padding: 30px;">
  <h2 style="text-align: center; color: #c0392b; margin-bottom: 30px;">
    🔥 Các Chương trình đào tạo năm 2025 của Trường Đại học Thương mại 🔥
  </h2>

  <div style="overflow-x: auto;">
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; text-align: center;">
      <thead style="background-color: #2980b9; color: white;">
        <tr>
          <th>STT</th>
          <th>Mã ngành</th>
          <th>Tên ngành</th>
          <th>Khoa quản lý</th>
          <th>Chương trình đào tạo</th>
          <th>Chỉ tiêu</th>
          <th>Phương thức xét tuyển 2025</th>
          <th>Tổ hợp xét tuyển 2025</th>
          <th>Điểm chuẩn 2023</th>
          <th>PT100 - 2024</th>
          <th>PT402a - 2024</th>
          <th>PT402b - 2024</th>
          <th>PT409 - 2024</th>
          <th>PT410 - 2024</th>
          <th>PT500 - 2024</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stt = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $stt++ . "</td>";
          echo "<td>" . htmlspecialchars($row['code']) . "</td>";
          echo "<td>" . htmlspecialchars($row['name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['department_name'] ?? '—') . "</td>";
          echo "<td>" . htmlspecialchars($row['program_name'] ?? '—') . "</td>";
          echo "<td>" . ($row['quota'] ?? '-') . "</td>";
          echo "<td>" . nl2br(htmlspecialchars($row['admission_methods_2025'])) . "</td>";
          echo "<td>" . nl2br(htmlspecialchars($row['subject_combinations_2025'])) . "</td>";
          echo "<td>" . ($row['entry_score_2023'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt100_2024'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt402a_2024'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt402b_2024'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt409_2024'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt410_2024'] ?? '-') . "</td>";
          echo "<td>" . ($row['score_pt500_2024'] ?? '-') . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
