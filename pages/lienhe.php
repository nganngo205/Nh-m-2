<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối CSDL
include __DIR__ . '/../config/db.php';

// Xử lý gửi form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $facebook = $_POST['facebook_link'];
    $question = $_POST['question'];
    $admin_id = 1;
    $trainingprogram_id = $_POST['program'];

    $sql = "INSERT INTO contact_form (fullname, phone, email, facebook_link, question, admin_id, trainingprogram_id)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssi", $fullname, $phone, $email, $facebook, $question, $admin_id, $trainingprogram_id);
    $stmt->execute();

    echo "<script>alert('Gửi thành công!'); window.location.href='index.php';</script>";
    exit;
}

// Lấy danh sách chương trình đào tạo để hiển thị trong select box
$programs = [];
$result = $conn->query("SELECT id, name FROM trainingprograms");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programs[] = $row;
    }
}
?>

<style>
.contact-section {
    display: flex;
    justify-content: space-between;
    padding: 40px 80px 80px 80px;
    background: #ffffff url('background.jpg') no-repeat center/cover;
    color: rgb(0, 0, 0);
    flex-wrap: wrap;
}

.contact-info {
    flex: 1;
    min-width: 250px;
    margin-right: 40px;
}

.contact-info h3 {
    font-size: 26px;
    line-height: 1.4;
}

.contact-info .orange {
    color: #f58220;
}

.contact-info p {
    margin: 10px 0;
    font-size: 16px;
}

.contact-form {
    flex: 1.2;
    min-width: 300px;
}

.contact-section form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 16px;
}

.contact-section .form-group label label {
    display: block;
    margin-bottom: 4px;
    font-weight: bold;
}

.contact-section input,
.contact-section select,
.contact-section textarea {
    width: 100%;
    padding: 10px;
    border: none;
    border-bottom: 2px solid rgb(0, 0, 0);
    background: transparent;
    font-size: 16px;
}
.contact-section button[type="submit"] {
  margin-top: 20px;
  padding: 12px 24px;
  background-color: #f58220; /* Màu cam TMU */
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.2s ease;
}

.contact-section button[type="submit"]:hover {
  background-color: #e1700c;
  transform: scale(1.03);
}

.contact-section button[type="submit"]:active {
  transform: scale(0.98);
}
</style>

<section class="contact-section">
    <div class="contact-info">
        <h3><span class="orange">Liên hệ</span> tư vấn tuyển sinh</h3>
        <p>📞 Hotline: 024 3764 3219</p>
        <p>📧 Email: tuyensinh@tmu.edu.vn</p>
        <p>🌐 Website: <a href="https://tmu.edu.vn" target="_blank">https://tmu.edu.vn</a></p>
    </div>

    <div class="contact-form">
        <form method="POST">
            <div class="form-group">
                <label for="fullname">Họ và tên *</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>

            <div class="form-group">
                <label for="phone">Số điện thoại *</label>
                <input type="text" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="facebook_link">Link Facebook</label>
                <input type="text" id="facebook_link" name="facebook_link">
            </div>

            <div class="form-group">
                <label for="program">Chương trình quan tâm *</label>
                <select name="program" id="program" required>
                    <option value="">-- Chọn chương trình --</option>
                    <?php foreach ($programs as $program): ?>
                        <option value="<?= $program['id'] ?>">
                            <?= htmlspecialchars($program['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="question">Câu hỏi cần tư vấn *</label>
                <textarea id="question" name="question" rows="4" required></textarea>
            </div>

            <button type="submit">Gửi liên hệ</button>
        </form>
    </div>
</section>

<script>
    const currentUrl = window.location.href;
const links = document.querySelectorAll(".main-nav a");

links.forEach(link => {
  const href = link.getAttribute("href");

  if (currentUrl.includes(href)) {
    links.forEach(l => l.classList.remove("active"));
    link.classList.add("active");
  }
});
</script>