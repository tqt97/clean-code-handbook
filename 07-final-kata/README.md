# 🧼 Module 7: Final Kata (Thử Thách Tổng Hợp)

> *"Clean Code không phải là đích đến, nó là một thói quen hàng ngày. Bạn không dọn nhà một năm một lần, bạn dọn mỗi ngày một chút."*

Refactoring (Tái cấu trúc) một đoạn Legacy Code là bài kiểm tra bản lĩnh thực sự của một Senior Engineer. Bạn không thể đập đi xây lại (Rewrite) từ đầu vì rủi ro tạo ra bug mới là quá cao. Bạn phải cấu trúc lại hệ thống đang chạy giống như thay động cơ cho một chiếc máy bay đang bay.

## 🎯 Mục tiêu của Kata này

1. **Thực hành quy trình an toàn:** Áp dụng từng kỹ thuật một cách độc lập. Không làm tất cả cùng lúc.
2. **Nhận diện mùi code (Code Smells):** Nhìn vào `legacy_code.php` và nhanh chóng phát hiện ra 6 loại lỗi chúng ta đã học.
3. **Củng cố kiến thức:** Kết hợp toàn bộ các kỹ thuật: Guard Clauses -> Enums -> DTO -> Syntactic Sugar -> Extract Method.

## 🚦 Quy trình Refactoring chuẩn mực từ chuyên gia

Trong thực tế, khi đối mặt với hàm `processBooking` dài 500 dòng, tôi sẽ làm theo thứ tự sau (Luật Bất Thành Văn):

1. **Phủ Test (Unit Tests):** Viết ít nhất 3-5 test cases cho luồng cũ để đảm bảo dù tôi có làm gì, output trả về vẫn không đổi (Đây là tấm lưới an toàn).
2. **Dọn rác trước (Module 3):** Xóa tất cả Zombie code, unreachable code. Cắt tỉa nhánh cây chết giúp bạn nhìn rõ thân cây hơn.
3. **Làm phẳng logic (Module 1):** Đảo ngược các lệnh `if` thành Guard Clauses để đẩy hết các case lỗi lên đầu hàm.
4. **Tiêu chuẩn hóa dữ liệu đầu vào (Module 6 & 2):** Chuyển mảng đầu vào thành DTO, chuyển số ma thuật thành Enums.
5. **Gom nhóm và Tách hàm (Module 5 & 4):** Biến những khối tính toán còn sót lại thành các private methods với tên gọi đọc như tiếng Anh (kèm theo các helpers/sugar).

Hãy mở file `legacy_code.php` và tự tay thực hành quy trình này trước khi mở file `clean_code.php` nhé! Chúc bạn may mắn.
