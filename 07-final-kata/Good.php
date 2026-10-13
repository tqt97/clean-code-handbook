<?php

use Carbon\Carbon;

// --- 1. GIẢI QUYẾT MAGIC VALUES BẰNG ENUM ---
enum RoomType: int
{
	case Standard = 1;
	case Deluxe = 2;
	case Suite = 3;
}

enum BookingStatus: int
{
	case Pending = 0;
	case Confirmed = 1;
}

// --- 2. GIẢI QUYẾT PRIMITIVE OBSESSION BẰNG DTO ---
class BookingRequest
{
	public function __construct(
		public int $roomId,
		public RoomType $type,
		public string $startDate,
		public string $endDate,
		public float $pricePerNight,
		public string $promoCode = ''
	) {
	}
}

class CleanBookingProcessor
{
	// Hàm chính giờ đây chỉ đóng vai trò "Nhạc trưởng" điều phối luồng chạy
	public function processBooking(?User $user, BookingRequest $request): string
	{
		// --- 3. GUARD CLAUSES (Loại bỏ Arrow Anti-pattern) ---
		if ($user === null) {
			throw new Exception("Chưa đăng nhập.");
		}

		if ($request->roomId <= 0) {
			throw new Exception("Phòng không hợp lệ.");
		}

		if ($this->isBlacklisted($user)) {
			throw new Exception("Tài khoản bị khóa.");
		}

		$nights = $this->calculateNights($request->startDate, $request->endDate);
		if ($nights <= 0) {
			throw new Exception("Ngày đặt không hợp lệ.");
		}

		// --- 4. EXTRACT METHOD & ĐẶT TÊN RÕ RÀNG (Không cần comment) ---
		$total = $this->calculateTotal($request, $nights);

		// Sử dụng Enum thay vì gán số 1
		$user->booking_status = BookingStatus::Confirmed;

		// --- 5. DỌN DẸP ZOMBIE CODE ---
		// Biến thừa, code bị comment đã bay màu.
		// Lệnh log được đưa lên TRƯỚC return để thực sự hoạt động.
		$this->logBooking($user->id);

		return "Booking Success! Total: $" . $total;
	}

	// --- CÁC HÀM PRIVATE GIÚP CODE TỰ GIẢI THÍCH ---

	private function isBlacklisted(User $user): bool
	{
		$blacklist = ['spammer@fake.com', 'badguy@scam.net'];
		return in_array($user->email, $blacklist);
	}

	private function calculateNights(string $startDate, string $endDate): int
	{
		// --- 6. SYNTACTIC SUGAR (Dùng Carbon thay cho Date intervals lằng nhằng) ---
		return Carbon::parse($startDate)->diffInDays(Carbon::parse($endDate));
	}

	private function calculateTotal(BookingRequest $request, int $nights): float
	{
		$total = $request->pricePerNight * $nights;

		// Enum giúp code dễ đọc như tiếng Anh
		if ($request->type === RoomType::Deluxe) {
			$total += 50 * $nights;
		}

		// Tính thuế 10%
		$total *= 1.10;

		// Syntactic sugar có sẵn của PHP 8
		if (str_starts_with($request->promoCode, 'SUMMER')) {
			$total -= 20;
		}

		return $total;
	}

	private function logBooking($userId): void
	{
		// Ghi log
	}
}