# php-webshop
php-webshop-demo


作業ディレクトリ
PHP-Webshop/app

コンテナ起動
docker compose up -d

コンテナ接続
docker exec -it app-php-1 /bin/bash

DB接続
mysql -u root -p -h app-db-1 app

コンテナ停止
docker compose down --remove-orphans

イメージフォルダ(画像データを配置)
PHP-Webshop/app/src/img
