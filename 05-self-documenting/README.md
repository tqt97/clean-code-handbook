# 🧼 Module 5: Code > Comments (Code Tự Giải Thích)

> *"Comment là sự xin lỗi của lập trình viên vì đã viết code quá khó hiểu."*

Trong những năm đầu làm quản lý, tôi từng yêu cầu team phải viết comment cho mọi hàm. Hệ quả là tôi nhận lại hàng tá rác rưởi kiểu: `// Gán i bằng 0` ngay trên dòng `$i = 0;`. Điều này hoàn toàn vô nghĩa. Comment là một sự bảo trì kép (Double Maintenance). Khi logic thay đổi, 90% lập trình viên quên cập nhật comment, tạo ra hiện tượng "Comment nói dối" - thứ nguy hiểm hơn cả việc không có comment.

## 🧠 Bản chất vấn đề

- Comment giải thích **CÁI GÌ (What)** và **NHƯ THẾ NÀO (How)** chứng tỏ biến và hàm được đặt tên quá tệ.
- Khối lượng code trong một hàm quá lớn (vượt quá 20 dòng), buộc lập trình viên phải chia block bằng comment để tự định hướng.

## 🛠 Giải pháp: Extract Method (Tách hàm)

Thay vì dùng comment làm tiêu đề cho một khối code logic, hãy bôi đen khối code đó và xuất nó ra thành một hàm `private` riêng biệt. Tên của hàm đó chính là tiêu đề thay thế cho comment.

- Biến một hàm dài 100 dòng thành một hàm gốc chứa 5-6 lệnh gọi hàm phụ. Hàm gốc bây giờ đọc như một mục lục cuốn sách.

## 💡 Lời khuyên từ chuyên gia

1. **Quy tắc duy nhất về Comment:** Chỉ viết comment để giải thích **TẠI SAO (Why)**. Tại sao lại dùng thuật toán này thay vì thuật toán kia? Tại sao lại phải `sleep(2)` ở đây? (Vd: Để tránh rate-limit của API ngân hàng).
2. **Single Responsibility Principle (SRP):** Tách hàm không làm code chạy chậm đi. Trình biên dịch PHP (OpCache) hiện đại xử lý các lời gọi hàm (function calls) cực kỳ tối ưu. Đừng hy sinh tính dễ đọc vì nỗi sợ viển vông về hiệu suất (Micro-optimization).
