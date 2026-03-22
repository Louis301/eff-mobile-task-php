
======================= Ход работы =======================

№1
установил и настроил Apache24, PhpMyAdmin, PHP, MySql, httpd и прочее.

№2
создал приложение на laravel командами в powerShell:
```
cd C:\Apache24\htdocs
composer create-project laravel/laravel eff-mobile-task-php
cd eff-mobile-task-php
```

№3
создал базу данных в phpMyAdmin:
```
CREATE DATABASE todo_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

№4
настроил (поправил) файл .env в директории  C:\Apache24\htdocs\eff-mobile-task-php
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_db
DB_USERNAME=Louis
DB_PASSWORD=hr3237hJJ@_2
```

№5
выполнил создание модели данных и миграцию БД командами в powerShell:
```
php artisan make:model Task -m
php artisan migrate
php artisan make:controller TaskController --resource
```


======================= Тестирование =======================

* с помощью расширения VS Code "Tunder Client"

Формат теста: 
```
<http_method> <http_query>
...
<response_body>
...
<result>
```

----------------- Тест 1

POST http://127.0.0.1:8000/api/tasks
...
{ "description": "Test" }
...
результат: 
  с ошибкой 422 (т.к. поле title обязательно)
  запись в таблицу не создалась

----------------- Тест 2

POST http://127.0.0.1:8000/api/tasks
...
{
  "title": "Купить молоко",
  "description": "В ближайшем магазине",
  "status": "new"
}
...
результат: 
  создана запись формата:
```
 {
    "id": 1,
    "title": "Купить молоко",
    "description": "В ближайшем магазине",
    "status": "new",
    "created_at": "2026-03-22T11:30:35.000000Z",
    "updated_at": "2026-03-22T11:30:35.000000Z"
  }
```

------------------- Тест 3

GET http://127.0.0.1:8000/api/tasks/1
...
результат: 
  возврат записи с id 1

------------------- Тест 4

GET http://127.0.0.1:8000/api/tasks
...
результат:
  получение всех записей в виде JSON

------------------- Тест 5

DELETE http://127.0.0.1:8000/api/tasks/1
...
результат:
  запись удалилась с телом ответа:
```
{
  "message": "Task deleted successfully"
}
```
