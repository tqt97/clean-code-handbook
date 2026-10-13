<?php

class BadDiscountManager
{
	// Tham số $strictValidation được truyền vào nhưng không bao giờ được sử dụng
	public function applyDiscount($order, $discountCode, $strictValidation = true)
	{
		// $oldPrice = $order->getTotal(); // Tính năng này bỏ từ ticket #123 rồi

		$finalPrice = $order->getTotal();
		$isSuccess = false;

		// Khai báo biến nhưng không bao giờ dùng tới
		$tempDiscount = 0;

		/*
		Code cũ của event năm ngoái, comment lại nhỡ năm sau sếp đòi dùng lại
		if ($discountCode === 'BLACKFRIDAY2023') {
			$finalPrice = $finalPrice * 0.5;
			return true;
		}
		*/

		if ($discountCode === 'SUMMER2026') {
			$finalPrice = $finalPrice - 50;
			$isSuccess = true;
		} else {
			// Không làm gì cả nhưng vẫn để else cho... an tâm
		}

		// die('Debug here');
		// return false; // Để tạm đây chưa biết có lỗi không

		$order->setTotal($finalPrice);
		return $isSuccess;

		// --- ZOMBIE CHÍNH HIỆU ---
		// Lệnh dưới đây không bao giờ được thực thi vì nó nằm sau lệnh return
		$this->logDiscountUsage($order->id, $discountCode);
	}

	private function logDiscountUsage($orderId, $code)
	{
		// Ghi log...
	}
}