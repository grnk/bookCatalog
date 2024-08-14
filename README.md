# Каталог книг

Для развёртывания проекта выполнить в корне проекта `docker compose up -d`

Зайти в контейнер с php `docker exec -it yii2_php bash`, затем перейти в директирию с приложением yii `cd /var/www/yii2-app/`,
выполнить `composer install` и `php init`.

Настроить подключение к базе данных в файле `/var/www/yii2-app/common/config/main-local.php`
```
'db' => [
    'class' => \yii\db\Connection::class
    'dsn' => 'mysql:host=book_catalog_yii2_mysql;dbname=yii2',
    'username' => 'yii2',
    'password' => 'yii2',
    'charset' => 'utf8',
],
```

Выполнить миграцию `php yii migrate`

Зарегистрировать пользователя или гостя http://localhost:8086/site/signup

Каталог книг http://localhost:8086/book/index

Авторы http://localhost:8086/author/index
