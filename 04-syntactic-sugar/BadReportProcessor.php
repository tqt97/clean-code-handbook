<?php

class BadReportProcessor
{
	public function process($filename, $jsonPayload)
	{
		// 1. Kiểm tra tiền tố chuỗi bằng strpos()
		// Cực kỳ dễ sinh bug nếu quên dùng toán tử === (vì 0 == false)
		if (strpos($filename, 'report_') === 0) {

			// 2. Decode JSON sang Array
			// Căn bệnh kinh điển: Quên truyền tham số `true` và nó trả về Object thay vì Array
			$data = json_decode($jsonPayload, true);

			// 3. Logic A/B Testing (Tỉ lệ 50-50)
			// Khó hiểu khi đọc lướt qua
			if (rand(1, 100) > 50) {
				$data['version'] = 'B';
			} else {
				$data['version'] = 'A';
			}

			// 4. Xử lý ngày tháng cực hình với hàm date() nguyên thủy
			// Bạn có hiểu 'w' là gì không? Số 2 là thứ mấy? (Chủ nhật là 0, Thứ hai là 1...)
			$isYesterdayTuesday = (date('w', strtotime('-1 day')) == 2);

			if ($isYesterdayTuesday) {
				// Xử lý báo cáo ngày Thứ Ba...
			}

			return $data;
		}

		throw new Exception("File không hợp lệ.");
	}
}