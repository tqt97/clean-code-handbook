# 🧼 PHP Clean Code - Deep Dive

Repository này được lập ra để thực hành và đào sâu vào các kỹ thuật viết Clean Code trong PHP. Mục tiêu là biến những đoạn code rườm rà, khó bảo trì thành code sạch, dễ đọc và an toàn hơn.

## 🎯 Mục tiêu

- Nắm vững và áp dụng các toán tử hiện đại của PHP (Elvis, Null Coalescing, Null Safe).
- Tư duy loại bỏ cấu trúc lồng ghép phức tạp bằng Guard Clauses.
- Thay thế các giá trị "Magic" bằng Enums (PHP 8.1+).
- Thoát khỏi "Primitive Obsession" bằng cách sử dụng Data Transfer Objects (DTO) và Value Objects.
- Thực hành nguyên tắc biến code trở nên tự giải thích (Self-documenting code) thay vì phụ thuộc vào comment.

## ⚙️ Yêu cầu hệ thống

- **PHP**: `>= 8.1` (Bắt buộc để sử dụng Enums và các tính năng mới).
- **Composer**: Để cài đặt các package hỗ trợ như `nesbot/carbon` (xử lý ngày tháng).
- **PHPUnit** (Tùy chọn): Nếu bạn muốn viết test để đảm bảo code sau khi refactor vẫn hoạt động đúng.

## 📂 Cấu trúc Repository

Repo được chia thành các thư mục/chủ đề chính. Mỗi chủ đề sẽ chứa code trước khi tối ưu (`bad.php`) và code sau khi áp dụng Clean Code (`good.php`).

1. `01-reducing-complexity/`: Các toán tử hiện đại và Guard Clauses.
2. `02-magic-values/`: Chuyển đổi hardcode sang Enums.
3. `03-zombie-code/`: Kỹ năng dọn dẹp source code.
4. `04-syntactic-sugar/`: Tạo helper functions và sử dụng Carbon.
5. `05-self-documenting/`: Refactor code thay cho comments.
6. `06-primitive-obsession/`: Chuyển đổi Array phức tạp thành DTOs.
7. `07-final-kata/`: Một bài tập tổng hợp kết hợp tất cả các kỹ năng trên.

## 🚀 Cách sử dụng

1. Clone repo này về máy.
2. Chạy `composer install` (nếu có sử dụng các thư viện ngoài).
3. Đi vào từng thư mục, đọc file `bad.php` để hiểu vấn đề.
4. Tự suy nghĩ cách giải quyết trước khi xem kết quả ở `good.php`.
