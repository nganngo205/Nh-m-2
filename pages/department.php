<?php
include __DIR__ . '/../config/db.php';

// Lấy danh sách khoa
$departments = mysqli_query($conn, "SELECT * FROM departments ORDER BY name");

// Lấy ngành, kèm theo chương trình đào tạo
$majors_by_dept = [];
$majors = mysqli_query($conn, "
  SELECT tm.id, tm.code, tm.name, tm.department_id, tp.name AS program_name
  FROM training_major tm
  LEFT JOIN trainingprograms tp ON tm.trainingprogram_id = tp.id
");

while ($row = mysqli_fetch_assoc($majors)) {
    $dept_id = $row['department_id'];
    if (!isset($majors_by_dept[$dept_id])) {
        $majors_by_dept[$dept_id] = [];
    }
    $majors_by_dept[$dept_id][] = $row;
}

$highlight_id = isset($_GET['highlight']) ? (int)$_GET['highlight'] : 0;
?>

<style>
h2 {
    text-align: center;
    color: #333;
    margin-top: 20px;
    margin-bottom: 20px;
}
.department-list {
    max-width: 900px;
    margin: 0 auto;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 40px;
}
.department-item {
    padding: 12px 18px;
    border-bottom: 1px solid #ddd;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.department-item:last-child {
    border-bottom: none;
}
.department-item:hover {
    background-color: rgb(255, 194, 161);
}
.department-name {
    font-weight: bold;
    color: #007BFF;
}
.major-table {
    display: none;
    padding: 0 20px 20px 20px;
}
.major-table table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
    background-color: #fff;
}
.major-table th, .major-table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}
.major-table th {
    background-color: #007BFF;
    color: white;
}
</style>

<h2>Danh sách Khoa/Viện Đào Tạo</h2>

<div class="department-list">
    <?php while ($dept = mysqli_fetch_assoc($departments)): ?>
        <div id="result-<?= $dept['id'] ?>" class="department-item" onclick="toggleMajors(<?= $dept['id'] ?>)" style="<?= $highlight_id === (int)$dept['id'] ? 'background-color: #ffe8cc;' : '' ?>">
            <span class="department-name"><?= htmlspecialchars($dept['name']) ?></span>
        </div>
        <div class="major-table" id="majors-<?= $dept['id'] ?>">
            <?php if (!empty($majors_by_dept[$dept['id']])): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Mã ngành</th>
                            <th>Tên ngành & Chương trình đào tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($majors_by_dept[$dept['id']] as $major): ?>
                            <tr>
                                <td><?= htmlspecialchars($major['code']) ?></td>
                                <td>
                                    <?= htmlspecialchars($major['name']) ?>
                                    <?php if (!empty($major['program_name'])): ?>
                                        <br><small style="color: gray;">(<?= htmlspecialchars($major['program_name']) ?>)</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="padding: 10px; font-style: italic;">⚠️ Không có ngành nào thuộc khoa này.</p>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</div>

<script>
function toggleMajors(id) {
    const table = document.getElementById('majors-' + id);
    if (table.style.display === 'block') {
        table.style.display = 'none';
    } else {
        document.querySelectorAll('.major-table').forEach(el => el.style.display = 'none');
        table.style.display = 'block';
        table.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const highlightId = <?= $highlight_id ?>;
    if (highlightId) {
        const target = document.getElementById('result-' + highlightId);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'center' });
            target.style.transition = 'background-color 0.5s ease';
            target.style.backgroundColor = '#ffe8cc';
            setTimeout(() => {
                target.style.backgroundColor = 'transparent';
            }, 3000);

            const majorsTable = document.getElementById('majors-' + highlightId);
            if (majorsTable) {
                majorsTable.style.display = 'block';
            }
        }
    }
});
</script>
