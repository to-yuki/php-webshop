<?php
namespace model;

use model\DatabaseManager;
use model\Account;

// グローバル名前空間からPDOをインポート
use PDO;
use PDOException;

class AccountsPDO {
	
	public function findByLogin($login) {
		$account = null;
		
		try {
			// Login オブジェクトからログインに必要な情報の取り出し
			$userId = $login->getUserId();
			$pass = $login->getPass();
			
			// DBコネクションの作成
			$conn = DatabaseManager::getConnection();
			
			// SQLクエリの準備(SELECT)
			$sql = "SELECT USER_ID, PASS, MAIL, NAME, AGE FROM ACCOUNTS WHERE USER_ID = :userId";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':userId', $userId);
			// SQLクエリの実行
			$stmt->execute();
			
			// Account オブジェクトへの変換
			if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$account = new Account();
				$account->setAll(
				$row['USER_ID'],
				$row['PASS'],
				$row['MAIL'],
				$row['NAME'],
				$row['AGE']
				);
			}

		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
			return null;
		}
		
		// 検索で見つかったユーザのAccountオブジェクトを返す
		return $account;
	}
	
	public function createAccount($account) {
		try {
			
			// DBに作成するユーザ情報の取り出し
			$userId = $account->getUserId();
			$pass =  $account->getPass();
			$mail = $account->getMail();
			$name = $account->getName();
			$age = $account->getAge();
			
			// DBコネクションの作成
			$conn = DatabaseManager::getConnection();
			
			//SQL クエリの準備(INSERT)
			$sql = "INSERT INTO ACCOUNTS (USER_ID, PASS, MAIL, NAME, AGE) VALUES (:userId, :pass, :mail, :name, :age)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':userId', $userId);
			$stmt->bindParam(':pass', $pass);
			$stmt->bindParam(':mail', $mail);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':age', $age);
			
			// SQLクエリの実行
			$updateCount = $stmt->execute();
			
			if ($updateCount === 0) {
				throw new PDOException("INSERT 0");
			}
		} catch (PDOException $e) {
			echo 'Error: ' . $e->getMessage();
			// DBに追加出来なかった場合は、nullを返す
			return null;
		}
		
		// DBに追加したユーザのアカウントオブジェクトを返す
		return $account;
	}
}

?>