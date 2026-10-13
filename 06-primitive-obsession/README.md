# 🧼 Module 6: Primitive Obsession (Thoát khỏi Mảng Cấu Trúc)

> *"Trong PHP, mảng (Array) là con dao pha. Nó có thể làm mọi thứ: List, Map, Queue, Stack... Nhưng dùng dao pha để phẫu thuật não thì đó là thảm họa."*

Primitive Obsession là căn bệnh dùng các kiểu dữ liệu nguyên thủy (Array, String, Int) để đại diện cho các khái niệm nghiệp vụ (Business Concepts). Ở môi trường PHP, căn bệnh này chủ yếu bộc lộ qua việc truyền các Associative Arrays khổng lồ xuyên qua các tầng của hệ thống. Bạn không bao giờ biết được mảng `$data` đó chứa cái gì cho đến khi bạn `var_dump()` nó ra.

## 🧠 Bản chất vấn đề

- **Mù thông tin:** IDE không thể Autocomplete (gợi ý) các key trong Array. Bạn phải nhớ bộ nhớ hoặc đoán.
- **Mỏng manh:** Dễ dàng gõ sai lỗi chính tả (`$user['eamil']` thay vì `$user['email']`). Trình biên dịch không bắt được lỗi này.
- **Bảo mật & Validation:** Ai đó có thể tiêm những key rác vào mảng ở tầng Controller và nó đi thẳng xuống Database. Bạn phải `isset()` liên tục mọi nơi.

## 🛠 Giải pháp: DTO (Data Transfer Object) và Value Object

Thay vì truyền mảng, hãy khởi tạo một Class để bọc dữ liệu đó lại.

1. **Data Transfer Object (DTO):** Cấu trúc dữ liệu thuần túy (như `PdfConfig`, `UserRegistrationData`). Chứa các thuộc tính định kiểu (Typed properties) và giá trị mặc định.
2. **Fluent Interface:** Tạo các hàm trả về `$this` (như `->withPreview()`) để xây dựng object một cách biểu cảm.

## 💡 Lời khuyên từ chuyên gia

- **Khóa băng DTO (Read-only):** Từ PHP 8.1 và 8.2, hãy sử dụng `readonly properties` hoặc `readonly class` cho DTO. Dữ liệu trung chuyển sau khi khởi tạo không bao giờ được phép thay đổi dọc đường (Immutability). Nó chặn đứng hàng ngàn bug do side-effects gây ra.
- Nếu bạn thấy một hàm có từ 4 tham số trở lên, đó là lúc bạn bắt buộc phải gom chúng lại thành một DTO.
