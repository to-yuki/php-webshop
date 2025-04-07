<?php

namespace model;

use model\DatabaseManager;
use model\Product;
use PDO;
use PDOException;

class ProductsPDO {
	
	private static ?array $productList = null;
	
	public function __construct() {
		$this->loadDB();
	}
	
	public function findByAll(): ?array {
		return self::$productList;
	}
	
	public function findByItemId(string $itemid): ?Product {
		foreach (self::$productList as $product) {
			if ($product->getProduct_id() === $itemid) {
				return $product;
			}
		}
		return null;
	}
	
	private function loadDB(): void {
		if (self::$productList === null) {
			self::$productList = [];
			
			// データベースへ接続
			try {
				$conn = DatabaseManager::getConnection(); // DatabaseManagerクラスで接続を取得
				
				// SELECT文を準備
				$sql = "SELECT PRODUCT_ID, PRODUCT_NAME, PRODUCT_DESCRIBE, IMG_URL, PRICE FROM PRODUCTS";
				$pStmt = $conn->prepare($sql);
				
				// SELECTを実行し、結果表を取得
				$pStmt->execute();
				$result = $pStmt->fetchAll(PDO::FETCH_ASSOC);
				
				foreach ($result as $row) {
					$product_id = $row['PRODUCT_ID'];
					$product_name = $row['PRODUCT_NAME'];
					$product_describe = $row['PRODUCT_DESCRIBE'];
					$img_url = $row['IMG_URL'];
					$price = $row['PRICE'];
					self::$productList[] = new Product($product_id, $product_name, $product_describe, $img_url, $price);
				}
			} catch (PDOException $e) {
				// エラーメッセージを表示
				echo $e->getMessage();
			}
		}
	}
}
?>