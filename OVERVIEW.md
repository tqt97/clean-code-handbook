# Clean Coding (Viết Code Sạch)

## 💡 Triết lý cốt lõi

> *"Code được đọc nhiều gấp 10 lần so với khi được viết ra."* - Uncle Bob Martin

Khi viết code, cần đặt ưu tiên cao nhất cho tính **dễ đọc, dễ hiểu và dễ bảo trì** (Developer Experience - DX). Đừng làm phức tạp hóa vấn đề.

---

## 🛠 6 Kỹ Thuật Viết Code Sạch (Clean Code Techniques)

### 1. Giảm Độ Phức Tạp & KISS (Keep It Simple and Stupid)

Mã nguồn càng phức tạp càng khó đọc. Hãy tận dụng các toán tử hiện đại của PHP để làm code ngắn gọn:

* **Elvis Operator (`?:`):** Viết tắt cho Ternary Operator nếu điều kiện và kết quả trả về giống nhau.
* **Null Coalescing Operator (`??`):** Kiểm tra biến/mảng có tồn tại không, nếu không thì trả về giá trị mặc định mà không gây lỗi.
* **Null Safe Operator (`?->`):** Gọi phương thức/thuộc tính một cách an toàn mà không sợ lỗi nếu Object là `null`. *(Lưu ý: Đừng lạm dụng nó để che giấu tất cả các lỗi trong hệ thống).*
* **Guard Clauses (Early Return):** Đừng lồng ghép nhiều câu lệnh `if/else` vào nhau. Hãy kiểm tra các điều kiện sai và `return` sớm ngay từ đầu hàm.

### 2. Tránh sử dụng "Magic Values"

* Không nên sử dụng trực tiếp các con số hoặc chuỗi (ví dụ: status `3`, type `"received"`) trong code vì dễ gây lỗi chính tả và người khác đọc sẽ không hiểu.
* **Giải pháp:** Thay thế chúng bằng **Constants (Hằng số)** hoặc tốt nhất là sử dụng **Enums (Từ PHP 8.1 trở lên)** để đảm bảo tính chặt chẽ và cung cấp ngữ cảnh rõ ràng.

### 3. Tiêu Diệt "Zombie Code"

* **Zombie Code là gì?** Là những đoạn code bị *comment lại* (vô hiệu hóa) hoặc các tham số, đoạn lệnh không bao giờ được gọi đến.
* **Tác hại:** Gây xao nhãng, khiến lập trình viên khác hoang mang không biết code này còn dùng nữa hay không.
* **Giải pháp:** Xóa bỏ hoàn toàn chúng. Hệ thống quản lý phiên bản (như Git) đã lưu lại lịch sử, không cần phải giữ lại trong source code.

### 4. Sử Dụng "Syntactic Sugar" (Cú pháp kẹo ngọt)

* Hãy tự tạo ra các hàm bọc (wrapper functions) để giúp thao tác dễ nhớ và dễ đọc hơn.
* *Ví dụ:* Thay vì dùng `json_decode($json, true)` (rất dễ quên tham số `true`), hãy viết một hàm `json_to_array()`.
* *Ví dụ:* Thay vì dùng `strpos() === 0` để kiểm tra chuỗi, hãy viết hàm `starts_with()`.

* Tận dụng các thư viện tốt, ví dụ như **Carbon** để xử lý ngày tháng. Đọc code `Carbon::yesterday()->isTuesday()` sẽ dễ hiểu như ngôn ngữ tự nhiên.

### 5. Hãy Viết Code Tự Giải Thích Thay Vì Viết Comment

> *"Comment là sự thừa nhận thất bại trong việc diễn đạt bằng code."*

* Không nên viết comment để giải thích *code đang làm gì*. Nó khiến code trở nên rườm rà, và đôi khi comment bị lỗi thời (code thay đổi nhưng người ta quên sửa comment).
* **Giải pháp:** Thay vì comment `// Kiểm tra xem user có địa chỉ thanh toán không`, hãy gom đoạn code đó thành một hàm có tên `hasBillingAddress()`.
* *Lưu ý:* Chỉ sử dụng comment khi cần giải thích **tại sao** (business logic, quy định cho legacy code...) - những thứ mà bản thân code không thể hiện được.

### 6. Tránh Bị Ám Ảnh Bởi Kiểu Dữ Liệu Nguyên Thủy (Primitive Obsession)

* Lập trình viên thường có xu hướng dùng **Array (Mảng)** để chứa các cấu trúc dữ liệu phức tạp vì nghĩ tạo Object là rườm rà.
* **Tác hại của Array:** Quá tự do (ai cũng có thể thêm/xóa key), không có type-hinting, IDE không gợi ý code, không có giá trị mặc định an toàn.
* **Giải pháp:** Sử dụng **Object / Data Transfer Object (DTO)**.
* Khai báo rõ kiểu dữ liệu (Type hinting).
* Có giá trị mặc định.
* Dùng *Fluent Setters* (chaining method) và các hàm tiện ích (`landscape()`, `paperWhite()`) để việc khởi tạo object trở nên rõ ràng và an toàn tuyệt đối.

---

**📌 Tóm lại:** Hãy code sao cho người tiếp theo đọc đoạn code của bạn (hoặc chính bạn của 6 tháng sau) có thể hiểu ngay lập tức mà không phải suy luận quá nhiều. Dùng Object thay cho Array, xóa code rác, và đặt tên hàm/biến mang tính diễn giải cao.
