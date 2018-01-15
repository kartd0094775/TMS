<?php
class Captcha extends CCaptchaAction {
	public $backColor = 0xFFFFFF;
	public $height = 40;
	protected function generateVerifyCode() {
		if ($this -> minLength < 5) {
			$this -> minLength = 5;
		}
		if ($this -> maxLength > 20) {
			$this -> maxLength = 20;
		}
		if ($this -> minLength > $this -> maxLength) {
			$this -> maxLength = $this -> minLength;
		}
		$length = mt_rand($this -> minLength, $this -> maxLength);

		$letters = '1234567890';
		$vowels = '2345109';
		$code = '';
		for ($i = 0; $i < $length; ++$i) {
			if ($i % 2 && mt_rand(0, 10) > 2 || !($i % 2) && mt_rand(0, 10) > 9) {
				$code .= $vowels[mt_rand(0, 4)];
			} else {
				$code .= $letters[mt_rand(0, 9)];
			}
		}
		return $code;
	}

}
