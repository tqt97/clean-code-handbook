<?php

class GoodCheckoutService
{
	public function processCheckout($user, $cart, $paymentInfo)
	{
		// 1. Dùng Guard Clauses (Early Return/Throw): Xử lý lỗi ngay lập tức
		if ($user === null) {
			throw new Exception("Người dùng chưa đăng nhập.");
		}

		if (empty($cart['items'])) {
			throw new Exception("Giỏ hàng của bạn đang trống.");
		}

		if ($paymentInfo === null) {
			throw new Exception("Thiếu thông tin thanh toán.");
		}

		// 2. Dùng Null Safe Operator (?->): Tránh lồng ghép isset()
		// Nếu $user->profile là null, $address sẽ là null mà không văng lỗi undefined property
		$address = $user->profile?->address;

		if ($address === null) {
			throw new Exception("Vui lòng cung cấp địa chỉ giao hàng.");
		}

		// 3. Dùng Elvis Operator (?:) hoặc Null Coalescing (??)
		// Nếu 'discount_code' tồn tại và không rỗng, lấy giá trị đó, ngược lại lấy 'NO_DISCOUNT'
		$discount = $cart['discount_code'] ?: 'NO_DISCOUNT';

		// Xử lý logic đặt hàng ở đây...
		return "Đặt hàng thành công tới địa chỉ: " . $address . " | Mã giảm giá: " . $discount;
	}
}