<?php

namespace model;

class Login {
	private $userId;
	private $pass;
	
	public function __construct($userId, $pass) {
		$this->userId = $userId;
		$this->pass = $pass;
	}
	
	public function getUserId() {
		return $this->userId;
	}
	
	public function getPass() {
		return $this->pass;
	}
}
?>