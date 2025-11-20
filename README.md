Tổng Quan
Website quảng bá trường học _ TMU là nơi chia sẻ thông tin về các ngành đào tạo và kế hoạch tuyển sinh, đồng thời cũng là công cụ hỗ trợ tương tác giữa nhà trường với người học và phụ huynh. Website cho phép người dùng xem các thông tin liên quan đến ngành đào tạo, hệ đào tạo và gửi câu hỏi liên hệ, và quản trị viên có thể quản lý, cập nhật nội dung website và xử lý các thông tin liên hệ từ người dùng. 
Yêu Cầu Hệ Thống
Yêu Cầu Kỹ Thuật
PHP 7.4 hoặc cao hơn
MySQL 5.7 hoặc cao hơn
Máy chủ web (Apache)
Trình duyệt web hiện đại có hỗ trợ JavaScript
Cấu Hình Cơ Sở Dữ Liệu
Host: localhost
Tên Database: quangba_tmu
Tên người dùng: root
Cấu hình mật khẩu mặc định (có thể được sửa đổi trong Config/Database.php)
Vai Trò Người Dùng Và Quyền Truy Cập
1.Quản trị viên
Quản lý tuyển sinh ( thêm, sửa, xóa, xem và khôi phục bài đã xóa, tải file tài liệu nếu cần)
Quản lý ngành đào tạo ( thêm, sửa, xóa)
Quản lý hoạt động sinh viên ( thêm, sửa, xóa)
Quản lý danh sách liên hệ
2.Người dùng
Xem nội dung thông tin ( ngành học, tuyển sinh, chương trình đào tạo…)
Gửi form liên hệ ( họ và tên, số điện thoại, email, link facebook, chương trình, câu hỏi)
USE CASES ( Ca Sử Dụng)
Use Case Xác thực
Đăng nhập
Tác nhân: Người dùng
Mô tả: Người dùng đăng nhập vào hệ thống bằng tên đăng nhập và mật khẩu
Luồng chính:
Người dùng truy cập trang đăng nhập
Điền tên đăng nhập và mật khẩu
Hệ thống xác thực thông tin
Chuyển hướng đến trang chính tương ứng với vai trò
Đăng xuất
Tác nhân: Người dùng đã đăng 
Mô tả: Người dùng đăng xuất khỏi hệ thống
Luồng chính:
Người dùng truy cập đăng xuất
Hệ thống xác thực thông tin
Hệ thống đăng xuất tài khoản cho người dùng
    d.Hệ thống chuyển hướng về trang Đăng nhập hoặc trang Trang chủ công khai.
Use Case Quản Trị Viên
Quản lý tuyển sinh
Tác nhân: Quản trị viên (Admin)
Mô tả: Quản trị viên quản lý các bài viết, thông báo liên quan đến tuyển sinh: tạo mới, chỉnh sửa, xóa mềm, khôi phục và tải file tài liệu đính kèm nếu có.
Luồng chính
 a. Quản trị viên đăng nhập và truy cập menu Quản lý tuyển sinh.
 b.Hệ thống hiển thị danh sách các bài tuyển sinh (tiêu đề, ngày đăng, trạng thái,…).
 c.Quản trị viên thực hiện một trong các thao tác:
            +)Thêm mới: chọn “Thêm”, nhập nội dung bài tuyển sinh, upload file tài liệu         (nếu cần), lưu.
            +) Sửa: chọn một bài, chỉnh sửa thông tin, lưu thay đổi.
            +)Xóa: chọn bài cần xóa, hệ thống đánh dấu là đã xóa (xóa mềm).
            +) Khôi phục: truy cập danh sách bài đã xóa, chọn bài cần khôi phục.
            +) Xem chi tiết / tải file: xem thông tin bài và tải file tài liệu đính kèm.
d.Hệ thống cập nhật CSDL và hiển thị danh sách mới nhất.
Quản lý ngành đào tạo
Tác nhân: Quản trị viên (Admin)
Mô tả: Quản trị viên quản lý danh sách các ngành đào tạo được hiển thị trên website.
Luồng chính
a. Quản trị viên truy cập mục Quản lý ngành đào tạo.
b.Hệ thống hiển thị danh sách các ngành (mã ngành, tên ngành, mô tả,…).
c.Quản trị viên có thể:
                       +)Thêm ngành mới: nhập các thông tin về ngành, lưu lại.
                       +)Sửa ngành: chọn một ngành, cập nhật nội dung và lưu.
                       +)Xóa ngành: chọn ngành cần xóa và xác nhận xóa.
d.Hệ thống cập nhật danh sách ngành đào tạo.
Quản lý hoạt động sinh viên
Tác nhân: Quản trị viên (Admin)
Mô tả: Quản trị viên đăng tải và quản lý thông tin về các hoạt động, sự kiện dành cho sinh viên.
Luồng chính
a.Quản trị viên truy cập Quản lý hoạt động sinh viên.
b.Hệ thống hiển thị danh sách các hoạt động/sự kiện (tên hoạt động, thời gian, địa điểm,…).
c.Quản trị viên có thể:
                           +) Thêm hoạt động: nhập thông tin chi tiết và lưu.
                           +)Sửa hoạt động: cập nhật nội dung hoạt động.
                           +)Xóa hoạt động: xóa hoạt động không còn hiệu lực.
d.Hệ thống lưu thay đổi và cập nhật danh sách hoạt động hiển thị trên website.
Xem danh sách liên hệ
Tác nhân: Quản trị viên (Admin)
Mô tả:  Quản trị viên xem và xử lý các form liên hệ mà người dùng gửi từ website.
Luồng chính
a. Quản trị viên truy cập chức năng Danh sách liên hệ.
b.Hệ thống hiển thị danh sách các liên hệ, bao gồm: họ tên, số điện thoại, email, link Facebook, chương trình quan tâm, nội dung câu hỏi, thời gian gửi.
c.Quản trị viên chọn một bản ghi để xem chi tiết.
d.Hệ thống lưu lại thay đổi trạng thái xử lý liên hệ.
Use Case Người dùng
Xem nội dung thông tin
Tác nhân: Người dùng (khách, học sinh, phụ huynh, sinh viên)
Mô tả: Người dùng xem các nội dung công khai trên website như ngành học, tuyển sinh, chương trình đào tạo, hoạt động sinh viên…
Luồng chính
a.Người dùng truy cập vào website TMU.
b.Chọn mục cần xem: Ngành đào tạo, Tuyển sinh, Chương trình đào tạo, Hoạt động sinh viên,…
c.Hệ thống hiển thị danh sách bài viết/tin tương ứng.
d.Người dùng chọn một bài cụ thể.
e.Hệ thống hiển thị nội dung chi tiết của bài viết.
Gửi form liên hệ
Tác nhân: Người dùng (khách, học sinh, phụ huynh, sinh viên)
Mô tả:Người dùng gửi câu hỏi, yêu cầu tư vấn hoặc góp ý cho nhà trường thông qua form liên hệ.
Luồng chính
a.Người dùng truy cập trang Liên hệ trên website.
b.Hệ thống hiển thị form liên hệ với các trường:
+)Họ và tên
+)Số điện thoại
+)Email
+)Chương trình/Ngành quan tâm
+)Câu hỏi/Nội dung cần tư vấn


c.Người dùng nhập thông tin và nhấn nút Gửi.


d.Hệ thống kiểm tra tính hợp lệ dữ liệu (bắt buộc, định dạng email, số điện thoại, …).
e.Nếu hợp lệ, hệ thống lưu thông tin vào CSDL.


h.Hệ thống hiển thị thông báo gửi thành công và (nếu có) thông điệp “Nhà trường sẽ phản hồi trong thời gian sớm nhất”.
Tính Năng Chính 
Hệ thống xác thực
Đăng nhập người dùng với tên đăng nhập và mật khẩu
Đăng ký người dùng với lựa chọn vai trò
Quản lý phiên làm việc
Mã hóa mật khẩu sử dụng password_hash của PHP
Quản Lý Bài Viết
Thêm bài viết mới với thông tin và loại bài viết
Cập nhật thông tin bài viết
Xóa bài viết
Xem thống kê bài viết
Quản lý loại bài viết
Tìm Kiếm và Đề Xuất Bài Viết
Tìm kiếm bài viết theo tiêu chí
Đề xuất bài viết theo các loại
Xem chi tiết bài viết
Mô Hình Dữ Liệu
admin
id (khóa chính)
username
password
admission
id (khóa chính)
admin_id ( khoá ngoại)
title
image_url
content
file_url
deleted_at
contact_form
id ( khóa chính)
admin_id ( khoá ngoại)
trainingprogram_id ( khóa ngoại)
fullname 
phone
email
facebook_link
question
created_at
departments
id ( khoá chính)
name
student_groups
id ( khoá chính)
admin_id ( khoá ngoại)
name
url
category
trainingprograms
id ( khoá chính)
name
training_major
id ( khoá chính)
trainingprogram_id (khoá ngoại)
admin_id ( khoá ngoại)
department_id ( khoá ngoại)
code
name
quota
admission_methods_2025
subject_combinations_2025
entry_score_2023
score_pt100_2024
score_pt409_2024
score_pt410_2024
score_pt500_2024
score_pt402a_2024
score_pt402b_2024
Yêu Cầu Giao Diện Người Dùng
Thiết kế đáp ứng tương thích với máy tính
Điều hướng trực quan
Bảng điều khiển để truy cập nhanh các tính năng quan trọng
Chỉ báo trực quan rõ ràng về các thông tin liên quan đến bài viết tuyển sinh, ngành học, sinh viên, liên hệ
Giao diện thân thiện với người dùng
Hỗ trợ Tiếng Việt
Yêu Cầu Báo Cáo
1.Hệ thống hỗ trợ thống kê:
Số lượng form liên hệ theo thời gian, theo chương trình đào tạo.


Số lượng bài tuyển sinh, ngành đào tạo, hoạt động sinh viên.
2. Cho phép xuất báo cáo dưới dạng bảng, file Excel/PDF.
Yêu Cầu Bảo Mật
Mã hoá mật khẩu đăng nhập
Quản lý các bài viết
Kiểm soát truy cập dựa trên vai trò
Các Tuyến Đường ( Routes) chính
Người dùng:
GET / – Trang chủ


GET /tuyen-sinh – Danh sách bài tuyển sinh


GET /tuyen-sinh/{id} – Chi tiết bài tuyển sinh


GET /nganh-dao-tao – Danh sách ngành/chương trình


GET /nganh-dao-tao/{id} – Chi tiết ngành


GET /hoat-dong-sinh-vien – Danh sách hoạt động sinh viên


GET /lien-he – Trang form liên hệ


POST /lien-he – Gửi form liên hệ
Admin:
GET /admin/login – Form đăng nhập


POST /admin/login – Xử lý đăng nhập


GET /admin/logout – Đăng xuất


GET /admin/dashboard – Bảng điều khiển


GET /admin/admission – Danh sách bài tuyển sinh


GET /admin/admission/create – Form thêm


POST /admin/admission – Lưu bài mới


GET /admin/admission/{id}/edit – Sửa


PUT/PATCH /admin/admission/{id} – Cập nhật


DELETE /admin/admission/{id} – Xóa (soft delete)


POST /admin/admission/{id}/restore – Khôi phục


Tương tự cho:


/admin/training-major (Quản lý ngành đào tạo)


/admin/student-groups (Quản lý hoạt động sinh viên)


/admin/contact (Xem liên hệ)
HƯỚNG DẪN SỬ DỤNG
Tài liệu hướng dẫn chi tiết cách sử dụng hệ thống có thể được tìm thấy trong thư mục /tai lieu bo sung/







