<?php

class GoodDiscountManager
{
	// Đã xóa tham số $strictValidation không sử dụng
	public function applyDiscount($order, $discountCode)
	{
		$finalPrice = $order->getTotal();
		$isSuccess = false;

		// Logic chính sạch sẽ, không có bình luận rác hay biến thừa
		if ($discountCode === 'SUMMER2026') {
			$finalPrice = $finalPrice - 50;
			$isSuccess = true;
		}

		$order->setTotal($finalPrice);

		// Chuyển phần log lên trước return để nó thực sự hoạt động
		if ($isSuccess) {
			$this->logDiscountUsage($order->id, $discountCode);
		}

		return $isSuccess;
	}

	private function logDiscountUsage($orderId, $code)
	{
		// Ghi log...
	}
}