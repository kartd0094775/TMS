<?php
class PhpMessageSource extends CPhpMessageSource {
	public function getMessages($category, $language) {
		return $this -> loadMessages($category, $language);
	}
}
