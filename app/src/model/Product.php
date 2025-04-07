<?php
namespace model;

class Product {
    // プロパティの定義
    private string $product_id;
    private string $product_name;
    private string $product_describe;
    private string $img_url;
    private float $price;
    
    public function __construct(string $product_id, string $product_name, string $product_describe, string $img_url, float $price) {
    $this->product_id = $product_id;
    $this->product_name = $product_name;
    $this->product_describe = $product_describe;
    $this->img_url = $img_url;
    $this->price = $price;
}

public function getProduct_id(): string {
    return $this->product_id;
}

public function getProduct_name(): string {
    return $this->product_name;
}

public function getProduct_describe(): string {
    return $this->product_describe;
}

public function getImg_url(): string {
    return $this->img_url;
}

public function getPrice(): float {
    return $this->price;
}

// __sleepメソッド
public function __sleep() {
    return ['product_id', 'product_name', 'product_describe', 'img_url', 'price'];
}

// __wakeupメソッド
public function __wakeup() {
    // 必要に応じて初期化処理を行う
}
}
?>