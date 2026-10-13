# 🧼 Module 2: No More Magic Values (Khước từ Giá trị Ma thuật)

> *"Những con số và chuỗi ký tự trần trụi rải rác trong code là những quả bom nổ chậm."*

"Magic Values" (Giá trị ma thuật) là những giá trị được hard-code trực tiếp như `status == 2`, `type == 'admin'`. Mười lăm năm trước, chúng tôi dùng `define()` hoặc Class Constants để giải quyết. Nhưng Constants vẫn thiếu an toàn vì bản chất chúng vẫn chỉ là một số Integer hoặc String, không có gì ngăn cản một developer truyền nhầm `99` vào một hàm đòi hỏi `status`.

Sự ra đời của **Backed Enums** trong PHP 8.1 là một bước ngoặt lớn, thay đổi hoàn toàn cách chúng ta định nghĩa các miền giá trị (domain values).

## 🧠 Bản chất vấn đề

- **Thiếu ngữ cảnh:** Số `2` có thể là trạng thái "Đã thanh toán", cũng có thể là vai trò "Editor", hoặc loại sản phẩm "Digital". Đọc code không thể hiểu được trừ khi tra cứu tài liệu.
- **Rủi ro Runtime:** Không có cơ chế ràng buộc kiểu (Type-safety). Lỗi chỉ phát sinh khi code đã chạy trên môi trường Production.
- **Rò rỉ logic (Logic Leakage):** Việc kiểm tra các Magic Value thường dẫn đến những chuỗi `switch/case` lặp đi lặp lại khắp hệ thống.

## 🛠 Giải pháp: PHP 8.1 Enums

Enums trong PHP không chỉ là một danh sách các giá trị, chúng là **Các đối tượng (Objects) Singleton**.

1. **Type-Hinting tuyệt đối:** Khi một hàm yêu cầu `OrderStatus $status`, bạn không thể truyền vào bất kỳ thứ gì khác ngoài một Enum case của OrderStatus.
2. **Đóng gói hành vi (Encapsulation):** Enums có thể chứa các phương thức (methods). Bạn có thể nhét logic lấy màu sắc, icon, nhãn hiển thị trực tiếp vào trong Enum thay vì viết các file Helpers lộn xộn.

## 💡 Lời khuyên từ chuyên gia

- **Trạng thái hữu hạn = Enum:** Bất cứ khi nào bạn có một cột trong Database chứa các giá trị hữu hạn (Status, Type, Role, Category cố định), hãy tạo một Backed Enum cho nó.
- **Sử dụng `match()` đi kèm Enum:** Đây là bộ đôi hoàn hảo. `match` bắt buộc bạn phải cover toàn bộ các cases của Enum, nếu thiếu, PHP sẽ ném lỗi Fatal Error. Điều này cứu sống bạn khi một ngày đẹp trời ai đó thêm một trạng thái mới vào hệ thống nhưng quên cập nhật logic hiển thị.
