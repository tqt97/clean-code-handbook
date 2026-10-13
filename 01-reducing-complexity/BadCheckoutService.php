<?php

class BadCheckoutService
{
	public function processCheckout($user, $cart, $paymentInfo)
	{
		// Kiểm tra user tồn tại
		if ($user !== null) {
			// Kiểm tra giỏ hàng có sản phẩm không
			if (isset($cart['items']) && count($cart['items']) > 0) {
				// Kiểm tra thông tin thanh toán
				if ($paymentInfo !== null) {

					// Lấy địa chỉ giao hàng (rất cồng kềnh)
					$address = null;
					if (isset($user->profile)) {
						if (isset($user->profile->address)) {
							$address = $user->profile->address;
						}
					}

					if ($address !== null) {

						// Lấy mã giảm giá (nếu không có thì dùng mặc định)
						if (isset($cart['discount_code']) && $cart['discount_code'] !== '') {
							$discount = $cart['discount_code'];
						} else {
							$discount = 'NO_DISCOUNT';
						}

						// Xử lý logic đặt hàng ở đây...
						return "Đặt hàng thành công tới địa chỉ: " . $address . " | Mã giảm giá: " . $discount;

					} else {
						throw new Exception("Vui lòng cung cấp địa chỉ giao hàng.");
					}
				} else {
					throw new Exception("Thiếu thông tin thanh toán.");
				}
			} else {
				throw new Exception("Giỏ hàng của bạn đang trống.");
			}
		} else {
			throw new Exception("Người dùng chưa đăng nhập.");
		}
	}
}