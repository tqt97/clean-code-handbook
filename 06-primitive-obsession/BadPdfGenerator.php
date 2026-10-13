<?php

class BadPdfGenerator
{
	// Tham số $config là một mảng rỗng tuếch, không có bất kỳ ranh giới bảo vệ nào
	public function generate(array $config)
	{
		// Phải liên tục kiểm tra và thiết lập giá trị mặc định (rất mệt mỏi)
		$width = $config['width'] ?? 210;
		$height = $config['height'] ?? 297;
		$bgColor = $config['background_color'] ?? '#FFFFFF';
		$showPreview = $config['preview'] ?? false;
		$hasSignature = $config['signature'] ?? false;

		echo "Tạo PDF: {$width}x{$height}, Nền: {$bgColor}";
		if ($showPreview)
			echo " [Chế độ Preview]";
		if ($hasSignature)
			echo " [Có chữ ký]";
		echo "\n";
	}
}

// ❌ CÁCH SỬ DỤNG GÂY ĐAU ĐẦU
$generator = new BadPdfGenerator();

$generator->generate([
	'width' => 800,
	'hight' => 600, // 🐛 LỖI CHÍNH TẢ: Gõ nhầm 'height' thành 'hight', hệ thống không hề báo lỗi!
	'background_color' => 'yellow',
	'preview' => 'có', // 🐛 LỖI KIỂU DỮ LIỆU: Truyền string thay vì boolean
	'random_key' => 'rác', // Truyền dữ liệu thừa thãi nhưng PHP vẫn vui vẻ chấp nhận
]);