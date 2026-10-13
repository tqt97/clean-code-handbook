<?php

require_once 'helpers.php';
use Carbon\Carbon;

class GoodReportProcessor
{
	public function process($filename, $jsonPayload)
	{
		// 1. Dùng hàm native của PHP 8 (chính PHP cũng bổ sung Syntactic Sugar cho cộng đồng)
		if (str_starts_with($filename, 'report_')) {

			// 2. Dùng Helper do ta tự định nghĩa
			$data = json_to_array($jsonPayload);

			// 3. Đoạn code bây giờ đọc như tiếng Anh tự nhiên
			if (coin_flip()) {
				$data['version'] = 'B';
			} else {
				$data['version'] = 'A';
			}

			// 4. Dùng thư viện Carbon để xử lý ngày tháng
			// Không cần nhớ mã định dạng ngày tháng 'Y-m-d' hay 'w' nữa!
			$isYesterdayTuesday = Carbon::yesterday()->isTuesday();

			if ($isYesterdayTuesday) {
				// Xử lý báo cáo ngày Thứ Ba...
			}

			return $data;
		}

		throw new Exception("File không hợp lệ.");
	}
}