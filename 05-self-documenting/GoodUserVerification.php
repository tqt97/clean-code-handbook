<?php

class GoodUserVerification
{
	public function verifyUser($user): bool
	{
		if (!$this->isOfLegalAge($user)) {
			return false;
		}

		if ($this->hasBlacklistedEmail($user)) {
			return false;
		}

		$this->activateAccount($user);

		return true;
	}

	private function isOfLegalAge($user): bool
	{
		$dob = new DateTime($user->dateOfBirth);
		$now = new DateTime();

		return $now->diff($dob)->y >= 18;
	}

	private function hasBlacklistedEmail($user): bool
	{
		$blacklistedDomains = ['spam.com', 'fake.net', 'disposable.org'];
		$emailParts = explode('@', $user->email);
		$domain = end($emailParts);

		return in_array($domain, $blacklistedDomains);
	}

	private function activateAccount($user): void
	{
		$user->isActive = true;
		$user->verifiedAt = date('Y-m-d H:i:s');
		$user->save();
	}
}