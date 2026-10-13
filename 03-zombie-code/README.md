# 🧼 Module 3: Zombie Code & Clean Up (Thanh trừng Code Chết)

> *"Source code không phải là bảo tàng. Nó là một cỗ máy đang vận hành."*

"Mình cứ comment đoạn này lại đã, nhỡ đâu tuần sau sếp lại đổi ý".
Đó là suy nghĩ của tôi khi mới vào nghề, và kết quả là dự án chứa đến 30% là các đoạn code bị đóng băng bằng `//` hoặc `/* */`. Zombie Code không gây lỗi hệ thống, nhưng nó bào mòn thứ quý giá nhất của một team kỹ thuật: **Khả năng đọc hiểu và niềm tin vào codebase.**

## 🧠 Bản chất vấn đề

- **Tiếng ồn thị giác (Visual Noise):** Mắt lập trình viên luôn phải lướt qua những đoạn code màu xám để tìm logic thực sự.
- **Sự hoang mang:** Một đoạn code không bao giờ được chạm tới (Unreachable code) hoặc biến không được dùng khiến người bảo trì tự hỏi: *"Tác giả quên xóa, hay nó có một side-effect (tác dụng phụ) ẩn nào đó mà mình chưa biết?"*
- **Bit Rot (Sự thối rữa của code):** Code bị comment lại sẽ không được refactor khi các API xung quanh thay đổi. Nếu một ngày bạn uncomment nó ra, chắc chắn nó sẽ làm crash hệ thống.

## 🛠 Giải pháp

1. **Xóa không khoan nhượng:** Nếu nó không chạy, hãy xóa nó.
2. **Tin tưởng vào Version Control (Git):** Git được sinh ra để lưu lịch sử. Nếu bạn cần đoạn code từ 3 tháng trước, lệnh `git log` hoặc `git blame` luôn sẵn sàng phục vụ.
3. **Chống Unreachable Code:** Không để bất kỳ logic nào bên dưới `return`, `throw` hoặc `die()`.

## 💡 Lời khuyên từ chuyên gia

- **Phát hiện Zombie bằng công cụ:** Đừng tìm thủ công. Hãy sử dụng các IDE hiện đại như PhpStorm (nó gạch chân màu xám các biến/hàm không được gọi) hoặc cấu hình **PHPStan / Rector** vào quy trình CI/CD. Chúng sẽ tự động chặn các Pull Request chứa code rác trước khi nó kịp xâm nhập vào nhánh `main`.
