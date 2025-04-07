<html>
    <body>
        <?php
        
        require_once '../pdo/ProductsPDO.php'; // Productsクラスのファイルをインクルード
        require_once '../pdo/Product.php';      // Productクラスのファイルをインクルード
        
        use pdo\DatabaseManager;
        use pdo\ProductsPDO;
        use pdo\Product;
        
        class ProductsPDOTest {
            
            private ProductsPDO $productsPDO;
            
            public function __construct() {
                // ProductsPDOのインスタンスを作成
                $this->productsPDO = new ProductsPDO();
            }
            
            public function testFindByAllReturnsProductList() {
                // findByAllメソッドを呼び出し
                $result = $this->productsPDO->findByAll();
                
                // 結果を表示
                if (count($result) > 0) {
                    echo "<p>testFindByAllReturnsProductList: <span style='color: green;'>OK</span></p>";
                } else {
                    echo "<p>testFindByAllReturnsProductList: <span style='color: red;'>FAILED</span></p>";
                }
                
                // 取得した値を表示
                echo "<h3>取得したプロダクトの詳細:</h3>";
                foreach ($result as $product) {
                    echo "<p>Product ID: " . $product->getProduct_id() . "</p>";
                    echo "<p>Product Name: " . $product->getProduct_name() . "</p>";
                    echo "<p>Description: " . $product->getProduct_describe() . "</p>";
                    echo "<p>Image URL: " . $product->getImg_url() . "</p>";
                    echo "<p>Price: " . $product->getPrice() . "</p>";
                }
            }
            
            public function testFindByItemIdReturnsCorrectProduct() {
                // 取得したいIDを指定
                $expectedId = 'P001';
                
                // findByItemIdメソッドを呼び出し
                $result = $this->productsPDO->findByItemId($expectedId);
                
                // 結果を表示
                if ($result) {
                    echo "<p>testFindByItemIdReturnsCorrectProduct: <span style='color: green;'>OK</span></p>";
                    echo "<h3>取得したプロダクトの詳細:</h3>";
                    echo "<p>Product ID: " . $result->getProduct_id() . "</p>";
                    echo "<p>Product Name: " . $result->getProduct_name() . "</p>";
                    echo "<p>Description: " . $result->getProduct_describe() . "</p>";
                    echo "<p>Image URL: " . $result->getImg_url() . "</p>";
                    echo "<p>Price: " . $result->getPrice() . "</p>";
                } else {
                    echo "<p>testFindByItemIdReturnsCorrectProduct: <span style='color: red;'>FAILED</span></p>";
                }
                
                // 存在しないIDを検索
                $resultNotFound = $this->productsPDO->findByItemId('3');
                if ($resultNotFound === null) {
                    echo "<p>testFindByItemIdReturnsNullForNonExistentProduct: <span style='color: green;'>OK</span></p>";
                } else {
                    echo "<p>testFindByItemIdReturnsNullForNonExistentProduct: <span style='color: red;'>FAILED</span></p>";
                }
            }
        }
        
        // テストを実行
        $test = new ProductsPDOTest();
        $test->testFindByAllReturnsProductList();
        $test->testFindByItemIdReturnsCorrectProduct();
        
        ?>
    </body>
</html>