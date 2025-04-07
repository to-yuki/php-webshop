<?php
// autoload.php
spl_autoload_register(function ($class_name) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class_name) . '.php';
    
    if (file_exists($file)) {
        include $file;
    } else {
        error_log("Class file not found: " . $file); // デバッグ用のログ出力
    }
});
?>