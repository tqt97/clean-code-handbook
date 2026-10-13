<?php

// Tạo một DTO (Data Transfer Object) chuyên biệt cho cấu hình PDF
class PdfConfig
{
	// 1. Khai báo rõ kiểu dữ liệu và giá trị mặc định an toàn
	public int $width = 210;
	public int $height = 297;
	public string $backgroundColor = '#FFFFFF';
	public bool $preview = false;
	public bool $signature = false;

	// 2. Tạo các hàm tiện ích (Syntactic Sugar) trả về self để hỗ trợ chaining (gọi chuỗi)
	public function setA4(): self
	{
		$this->width = 210;
		$this->height = 297;
		return $this;
	}

	public function landscape(): self
	{
		// Hoán đổi chiều rộng và chiều cao
		$temp = $this->width;
		$this->width = $this->height;
		$this->height = $temp;
		return $this;
	}

	public function paperWhite(): self
	{
		$this->backgroundColor = '#FFFFFF';
		return $this;
	}

	public function withPreview(): self
	{
		$this->preview = true;
		return $this;
	}
}

class GoodPdfGenerator
{
	// Yêu cầu truyền vào đúng đối tượng PdfConfig (Type-Safety tuyệt đối)
	public function generate(PdfConfig $config)
	{
		echo "Tạo PDF: {$config->width}x{$config->height}, Nền: {$config->backgroundColor}";
		if ($config->preview)
			echo " [Chế độ Preview]";
		if ($config->signature)
			echo " [Có chữ ký]";
		echo "\n";
	}
}

// ✅ CÁCH SỬ DỤNG THANH LỊCH VÀ AN TOÀN
$generator = new GoodPdfGenerator();

// Khởi tạo Object
$config = new PdfConfig();

// Bạn có thể tùy chỉnh các thuộc tính thông qua các hàm tiện ích rất rõ nghĩa
$config->setA4()
	->landscape()
	->paperWhite()
	->withPreview();

$generator->generate($config);

// Lợi ích cực lớn:
// 1. Bạn gõ $config-> IDE sẽ tự xổ ra danh sách gợi ý (landscape, setA4, width...).
// 2. Bạn không thể truyền sai kiểu dữ liệu ($config->width = "Hello" sẽ báo lỗi ngay).
// 3. Không thể gõ sai chính tả thuộc tính.