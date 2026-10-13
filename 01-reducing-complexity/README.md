# 🧼 Module 1: Reducing Complexity (Giảm thiểu độ phức tạp)

> *"Sự phức tạp là kẻ thù số một của phần mềm. Nó làm chậm quá trình phát triển, gây ra lỗi và khiến lập trình viên kiệt sức."*

Trong những năm đầu sự nghiệp, tôi từng nghĩ code càng lồng ghép nhiều vòng `if/else`, logic càng "khủng" thì càng thể hiện trình độ. Đó là một sai lầm chết người. Một bộ não người bình thường chỉ có thể giữ được 4-7 biến số trong bộ nhớ ngắn hạn. Khi bạn viết những khối code thụt lề hình mũi tên (Arrow Anti-Pattern), bạn đang bắt đồng nghiệp (hoặc chính bạn 6 tháng sau) phải mô phỏng lại một cỗ máy trạng thái khổng lồ trong đầu.

## 🧠 Bản chất vấn đề

- **Arrow Anti-Pattern:** Các khối `if/else` lồng nhau khiến code trôi dần về bên phải màn hình. Mỗi một cấp lồng ghép làm tăng gấp đôi số lượng Test Case bạn phải viết.
- **Phòng thủ thái quá:** Sử dụng `isset()` và `!== null` khắp mọi nơi làm lu mờ đi business logic (nghiệp vụ cốt lõi) thực sự của đoạn code.

## 🛠 Giải pháp & Kỹ thuật

1. **Bảo vệ từ cửa (Guard Clauses):** Đảo ngược tư duy. Thay vì kiểm tra điều kiện ĐÚNG để đi tiếp, hãy kiểm tra điều kiện SAI để dừng lại ngay lập tức (`return` hoặc `throw`). Điều này giúp hàm luôn giữ được độ thụt lề ở cấp độ 1 (Flat code).
2. **Elvis Operator (`?:`):** Cứu cánh tuyệt vời cho các thao tác gán giá trị mặc định khi biến có thể mang giá trị falsy.
3. **Null Coalescing (`??`):** Thay thế hoàn hảo cho `isset()`.
4. **Null Safe Operator (`?->`):** (Từ PHP 8.0) Ngăn chặn exception "Call to a member function on null" mà không cần viết các câu lệnh `if` rườm rà.

## 💡 Lời khuyên

- **Đừng lạm dụng Null Safe (`?->`):** Tôi đã thấy nhiều dự án sụp đổ trong im lặng vì lập trình viên lạm dụng `?->` khắp mọi nơi. Nó giống như việc bạn rút giắc cắm chuông báo cháy khi nhà đang cháy. Chỉ dùng `?->` khi thuộc tính đó **được phép null** theo logic nghiệp vụ. Nếu nó bắt buộc phải có, hãy để hệ thống quăng Exception, bạn sẽ dễ fix bug hơn.

## So sánh và bài học rút ra

- Guard Clauses loại bỏ Else: Thay vì gói toàn bộ luồng chính trong nhánh if (đúng), chúng ta chặn các trường hợp sai ở ngay đầu hàm. Mọi thứ lọt qua được các chốt chặn này đều là dữ liệu hợp lệ. Code giảm từ 4 cấp độ thụt lề (```indentation```) xuống còn 1 cấp.

- Hàm **```empty()```** là **"```KISS```**": Thay vì viết ```isset($cart['items']) && count($cart['items']) > 0```, hàm ```empty()``` thực hiện cả hai việc kiểm tra tồn tại và kiểm tra rỗng một cách an toàn và ngắn gọn.

- **Null Safe** ```(?->)```: Cứu bạn khỏi thảm họa viết chuỗi ```if (isset($a->b->c))``` mỗi khi làm việc với Object có cấu trúc sâu.

- **Elvis Operator** ```(?:)```: Thay thế khối if/else gán biến nhàm chán thành 1 dòng code thanh lịch.

Hai toán tử này rất dễ gây nhầm lẫn vì chúng đều dùng để gán giá trị mặc định. Tuy nhiên, sự khác biệt cốt lõi nằm ở **cách chúng đánh giá dữ liệu**:

- **Toán tử Null Coalescing (`??`)**: Chỉ quan tâm biến đó có **tồn tại** và **khác `null**` hay không.
- **Toán tử Elvis (`?:`)**: Quan tâm biến đó có mang giá trị **Truth (đúng/có giá trị thực)** hay không (dựa trên cách PHP ép kiểu sang Boolean).

---

Dưới đây là chi tiết khi nào nên dùng từng loại:

## 1. Khi nào dùng Null Coalescing (`??`)

Sử dụng `??` khi bạn muốn lấy dữ liệu từ một biến, một mảng hoặc request (GET/POST) mà **bạn không chắc chắn biến/key đó đã được khởi tạo hay chưa**.

Toán tử này an toàn vì nó hoạt động giống như `isset()`. Nó sẽ không báo lỗi cảnh báo (Warning/Notice) nếu biến không tồn tại. Nếu biến không tồn tại hoặc bằng `null`, nó sẽ lấy giá trị vế sau. Các giá trị như `0`, `""` (chuỗi rỗng), hoặc `false` vẫn được coi là hợp lệ và được giữ nguyên.

```php
// Dùng an toàn với array key chưa được khai báo
$page = $_GET['page'] ?? 1;

// Hoặc với Object thuộc tính có thể null
$address = $user->address ?? 'Chưa cập nhật';

// Chuỗi rỗng hoặc số 0 VẪN được chấp nhận
$qty = $data['qty'] ?? 10;
// Nếu $data['qty'] = 0, $qty sẽ bằng 0 (không bị biến thành 10).

```

## 2. Khi nào dùng Elvis Operator (`?:`)

Sử dụng `?:` khi biến của bạn **chắc chắn đã được khởi tạo**, nhưng bạn muốn cung cấp một giá trị dự phòng nếu biến đó là rỗng, `0`, `false`, `null`, hoặc mảng rỗng (hoạt động giống như hàm `empty()`).

**Cảnh báo:** Nếu bạn dùng `?:` với một biến chưa được khai báo hoặc một key không tồn tại trong mảng, PHP 8+ sẽ ném ra lỗi `Warning: Undefined variable` hoặc `Undefined array key`.

```php
$discountCode = ""; // Đã được khởi tạo nhưng là chuỗi rỗng

// Dùng ?: vì bạn muốn ép chuỗi rỗng thành giá trị mặc định
$appliedCode = $discountCode ?: 'NO_DISCOUNT';
// Kết quả: 'NO_DISCOUNT'

// Ví dụ khác với số 0
$points = 0;
$multiplier = $points ?: 1;
// Kết quả: 1 (vì 0 bị coi là falsy)

```

---

## Bảng so sánh nhanh (Cheat Sheet)

Giả sử chúng ta gán `$b = $a ?? 'Mặc định'` và `$b = $a ?: 'Mặc định'`. Kết quả `$b` sẽ như sau:

| Giá trị của `$a` | Dùng `??` (Null Coalescing) | Dùng `?:` (Elvis) |
| --- | --- | --- |
| **Chưa được khai báo** | `'Mặc định'` | `'Mặc định'` *(Kèm theo Warning lỗi)* |
| `null` | `'Mặc định'` | `'Mặc định'` |
| `""` (Chuỗi rỗng) | `""` | `'Mặc định'` |
| `0` hoặc `"0"` | `0` | `'Mặc định'` |
| `false` | `false` | `'Mặc định'` |
| `[]` (Mảng rỗng) | `[]` | `'Mặc định'` |

## 💡 Quy tắc "bỏ túi" (Rule of Thumb)

1. Lấy dữ liệu từ ngoài vào (`$_GET`, `$_POST`, JSON payload, CSDL) hoặc đối phó với biến chưa chắc đã tồn tại $\rightarrow$ **Dùng `??**`.
2. Kiểm tra một biến đã có sẵn nhưng có nguy cơ mang các giá trị "vô nghĩa" (chuỗi rỗng, số 0) và muốn ép nó về giá trị mặc định $\rightarrow$ **Dùng `?:**`.
