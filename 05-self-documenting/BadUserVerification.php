<?php

class BadUserVerification
{
	public function verifyUser($user)
	{
		// Kiểm tra xem người dùng đã đủ 18 tuổi chưa
		// Tính từ ngày sinh đến ngày hiện tại
		$dob = new DateTime($user->dateOfBirth);
		$now = new DateTime();
		$age = $now->diff($dob)->y;
		if ($age < 18) {
			return false;
		}

		// Kiểm tra xem email có nằm trong danh sách đen không
		// Tách chuỗi email để lấy phần domain phía sau dấu @
		$blacklistedDomains = ['spam.com', 'fake.net', 'disposable.org'];
		$emailParts = explode('@', $user->email);
		$domain = end($emailParts);
		if (in_array($domain, $blacklistedDomains)) {
			return false;
		}

		// Kích hoạt tài khoản và gán thời gian xác thực
		// Cần lưu vào database ngay lập tức
		$user->isActive = true;
		$user->verifiedAt = date('Y-m-d H:i:s');
		$user->save();

		return true;
	}
}