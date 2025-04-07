<?php

namespace model;

class Account {
	private string $userId;
	private string $pass;
	private string $mail;
	private string $name;
	private int $age;
	
	public function __construct(string $userId = '', string $pass = '', string $mail = '', string $name = '', int $age = 0) {
		$this->userId = $userId;
		$this->pass = password_hash($pass, PASSWORD_DEFAULT);
		$this->mail = $mail;
		$this->name = $name;
		$this->age = $age;
	}

	public function setAll(string $userId, string $pass, string $mail, string $name, int $age) {
		$this->userId = $userId;
		$this->pass = $pass;
		$this->mail = $mail;
		$this->name = $name;
		$this->age = $age;
	}


	public function getUserId(): string {
		return $this->userId;
	}
	
	// ハッシュ化されたパスワードの比較チェック
	public function verifyPassword(string $inputPass): bool {
		return password_verify($inputPass, $this->pass); // 入力されたパスワードを検証
	}

	public function getPass(): string {
		return $this->pass;
	}

	public function getMail(): string {
		return $this->mail;
	}
	
	public function getName(): string {
		return $this->name;
	}
	
	public function getAge(): int {
		return $this->age;
	}
	
	// __sleepメソッド
	public function __sleep() {
		// シリアライズ時に保存するプロパティを指定
		return ['userId' ,'mail', 'name', 'age']; // パスワードは保存しない
	}
	
	// __wakeupメソッド
	public function __wakeup() {
		// 必要に応じて初期化処理を行う
		// 例えば、デフォルトの値を設定したり、データベース接続を再設定したりできます
	}
}
?>