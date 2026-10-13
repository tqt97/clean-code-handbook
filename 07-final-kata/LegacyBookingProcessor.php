<?php

class LegacyBookingProcessor
{
	// LỖI 3 (Zombie Code): Tham số $strictMode không bao giờ được dùng
	// LỖI 6 (Primitive Obsession): Nhận vào một array mập mờ thay vì Object
	public function processBooking($user, array $bookingData, $strictMode = true)
	{
		// LỖI 1 (Arrow Anti-pattern): If/else lồng ghép mù mịt
		if ($user !== null) {
			if (isset($bookingData['room_id']) && $bookingData['room_id'] > 0) {

				// LỖI 5 (Comments thay vì Code): Dùng comment để giải thích logic tính ngày
				// LỖI 4 (Thiếu Syntactic Sugar): Dùng DateTime thô cứng
				$startDate = new DateTime($bookingData['start_date']);
				$endDate = new DateTime($bookingData['end_date']);
				$days = $startDate->diff($endDate)->days;

				if ($days > 0) {

					// LỖI 5: Dùng comment giải thích logic Blacklist
					$blacklist = ['spammer@fake.com', 'badguy@scam.net'];
					if (!in_array($user->email, $blacklist)) {

						// LỖI 3 (Zombie): Biến khai báo nhưng không dùng
						$tempTotal = 0;

						$price = $bookingData['price'] ?? 0;

						// LỖI 5: Tính tổng tiền và thuế (logic rối rắm nằm chung 1 hàm)
						$total = $price * $days;
						$total = $total + ($total * 0.10);

						// LỖI 2 (Magic Value): Số "2" nghĩa là gì? (Phòng Deluxe?)
						if (isset($bookingData['room_type']) && $bookingData['room_type'] == 2) {
							$total += 50 * $days; // Phụ thu
						}

						// LỖI 4 (Thiếu Sugar): strpos dễ sai sót
						if (isset($bookingData['promo']) && strpos($bookingData['promo'], 'SUMMER') === 0) {
							$total -= 20;
						}

						/* 
						// LỖI 3 (Zombie): Code cũ bị comment lại
						if ($user->isVip) {
							$total = $total * 0.8;
						}
						*/

						// LỖI 2 (Magic Value): Gán status bằng 1
						$user->booking_status = 1;

						return "Booking Success! Total: $" . $total;

						// LỖI 3 (Zombie): Unreachable code (lệnh nằm sau return)
						$this->logBooking($user->id);

					} else {
						throw new Exception("Tài khoản bị khóa.");
					}
				} else {
					throw new Exception("Ngày đặt không hợp lệ.");
				}
			} else {
				throw new Exception("Phòng không hợp lệ.");
			}
		} else {
			throw new Exception("Chưa đăng nhập.");
		}
	}

	private function logBooking($userId)
	{
		// Ghi log
	}
}