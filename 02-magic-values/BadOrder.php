<?php

class BadOrder
{
    public int $status;

    public function __construct()
    {
        // 1: Pending (Chờ xử lý)
        $this->status = 1;
    }

    // Nhận vào một số nguyên (nguy cơ bị truyền sai giá trị rất cao)
    public function setStatus(int $status): void
    {
        // Phải tự kiểm tra dữ liệu đầu vào (Validation thủ công)
        $validStatuses = [1, 2, 3, 4];
        if (!in_array($status, $validStatuses)) {
            throw new InvalidArgumentException("Trạng thái không hợp lệ!");
        }

        $this->status = $status;
    }

    // Logic hiển thị màu sắc bị rò rỉ ra ngoài class Order
    public function getStatusColor(): string
    {
        switch ($this->status) {
            case 1:
                return 'gray';
            case 2:
                return 'blue';
            case 3:
                return 'green';
            case 4:
                return 'red';
            default:
                return 'unknown';
        }
    }
}

// ❌ CÁCH SỬ DỤNG GÂY BỐI RỐI
$order = new BadOrder();

// Nhìn dòng lệnh này, không ai biết số 2 nghĩa là gì!
$order->setStatus(2);

// Lỗi tiềm ẩn: Truyền nhầm số 99. Mã sẽ ném lỗi khi chạy thực tế (Runtime).
// $order->setStatus(99);