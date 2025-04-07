<?php

namespace model;

// グローバル名前空間からPDOをインポート
use Exception;
use PDO;
use PDOException;

class DatabaseManager {
	
	// MySQL-Server connect Check Command :: mysql -u root -p -h app-db-1 app 
	private static $dsn = 'mysql:host=app-db-1;dbname=app';
	private static $username = 'root';
	private static $password = 'pass';
	
	private static $pdo = null;
	
	// コンストラクタをプライベートにして、インスタンス化を防ぐ
	private function __construct() {}
	
	// データベース接続を取得するメソッド
	public static function getConnection() {
		if (self::$pdo === null) {
			try {
				self::$pdo = new PDO(self::$dsn, self::$username, self::$password);
				self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				throw new Exception('データベース接続に失敗しました: ' . $e->getMessage());
			}
		}
		return self::$pdo;
	}
}

// 使用例
// try {
// 	$db = DatabaseManager::getConnection();
// 	// データベース操作をここで行う
// } catch (Exception $e) {
// 	echo $e->getMessage();
// }
?>