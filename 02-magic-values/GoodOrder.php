<?php

// Định nghĩa Enum chứa các trạng thái hợp lệ và được "Backed" bởi kiểu int
enum OrderStatus: int
{
    case Pending = 1;
    case Paid = 2;
    case Shipped = 3;
    case Cancelled = 4;

    // Tính đóng gói (Encapsulation): Logic màu sắc nằm ngay trong Enum
    // Sử dụng biểu thức match() của PHP 8.0 cho code gọn gàng hơn switch
    public function color(): string
    {
        return match($this) {
            self::Pending => 'gray',
            self::Paid => 'blue',
            self::Shipped => 'green',
            self::Cancelled => 'red',
        };
    }

    public function label(): string
    {
        return match($this) {
            self::Pending => 'Chờ xử lý',
            self::Paid => 'Đã thanh toán',
            self::Shipped => 'Đã giao hàng',
            self::Cancelled => 'Đã hủy',
        };
    }
}

class GoodOrder
{
    public OrderStatus $status;

    public function __construct()
    {
        $this->status = OrderStatus::Pending;
    }

    // Sử dụng Type Hinting trực tiếp với Enum
    public function setStatus(OrderStatus $status): void
    {
        // Không cần validation thủ công nữa, PHP sẽ lo việc đó ở mức ngôn ngữ!
        $this->status = $status;
    }
}

// ✅ CÁCH SỬ DỤNG RÕ RÀNG VÀ AN TOÀN TỐI ĐA
$order = new GoodOrder();

// Nhìn vào code là hiểu ngay mục đích: Đặt trạng thái thành "Đã thanh toán"
$order->setStatus(OrderStatus::Paid);

// Lấy thông tin màu sắc và nhãn rất dễ dàng
echo "Đơn hàng: " . $order->status->label(); // Đầu ra: Đơn hàng: Đã thanh toán
echo "Màu sắc: " . $order->status->color();  // Đầu ra: Màu sắc: blue

// Nếu cố tình gọi sai kiểu (ví dụ: $order->setStatus(2) hoặc $order->setStatus(99)),
// IDE (như PhpStorm/VSCode) sẽ báo lỗi đỏ ngay lập tức TRƯỚC KHI chạy code.