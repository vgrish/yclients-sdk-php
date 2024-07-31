# yclients-sdk-php

# SDK для работы с API v1.0 сервиса Yclients

Библиотека, позволяющая работать с [Yclients API](https://developers.yclients.com/ru/) и `PHP 8.1+`.

Находится в разработке, версии могут не обладать обратной совместимостью. Список изменений можно найти
в [Changelog](CHANGELOG.md).

## Установка

```bash
composer vgrish/yclients-sdk-php
```

## Быстрый старт

```php
use Vgrish\Yclients\Yclients;

$yc = Yclients::getInstance()
    ->setPartnerToken('Partner_token')
    ->setUserToken('User_token');

//Конструктор запросов
$auth = $yc->query()
    ->user()
    ->auth()
    ->param([
        'login'    => 'телефон пользователя',
        'password' => 'пароль пользователя',
    ])
    ->create();

//Получаем токен пользователя
$userToken = $auth->object()->getUserToken();

//Устанавливаем токен пользователя
$yc->setUserToken($userToken);

//Получаем клиентов компании
$clients = $yc->query()
    ->clients()
    ->path('company_id', '111111')
    ->param([
        'fields' => [
            'id',
            'name',
            'phone',
            'email',
        ],
    ])
    ->pageSize(5)
    ->page(1)
    ->get();

foreach ($clients->objects() as $client) {
    var_dump($client->getId().':'$client->getName());
}
```

## Особенности

Библиотека предоставляет конструктор запросов (Query) для работы с API.

## Конструктор запросов

Позволяет при помощи fluent-цепочки методов собрать запрос к API Yclients.
Конструктор запросов вызывается при помощи метода `query()` базового объекта библиотеки.

```php
use Vgrish\Yclients\Yclients;

$yc = Yclients::getInstance()
    ->setPartnerToken('Partner_token')
    ->setUserToken('User_token');
$yc->query()->...;
```

## Методы формирования запроса

### Сегменты

Делятся на два вида:

* `основной` - первый сегмент в запросе после `query()`. Примеры: `clients()`, `loyalty()`.
* `второстепенный` - сегменты, следующие после `основного`. Примеры: `auth()`, `card()`.

Сегменты могут иметь набор различных вложенных сегментов и методов которыми обладает сущность, представляемая сегментом.

### Путь запроса

* `path()` метод для формирования параметров пути запроса.
  Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива.

```php
$yc->query()
    ->client()
    ->path('company_id', '11111')
    ->path('id', '22222222')
    //или
    ->path(['company_id' => '11111', 'id' => '22222222'])
    //или
    ->path([
       ['company_id', '11111'],
       ['id', '22222222'],
    ])
    ->get();
```

### Параметры запроса

* `param()` метод для формирования параметров запроса.
  Несколько параметров можно применить, вызвав метод несколько раз, или при помощи массива.

```php
$yc->query()
    ->loyalty()
    ->transactions()
    ->path('chain_id', '33333')
    ->param([
         'created_after'  => '2024-07-10',
         'created_before' => '2024-07-31',
         'company_ids[]'  => '204265',
         ['types[]', [5, 6]],
    ])
    ->get([]);
```

* `page($value)` - установка страницы пагинации.
* `count($value)` - установка кол-ва результатов выборки.
* `pageSize($value)` - установка кол-ва результатов выборки. (у разнах сущностей разные параметры запроса)

## Методы отправки запросов

Запрос (`$request`) можно передавать напрямую в метод запроса в формате array.

* `create($request)` - `POST` запрос для создания сущности.

```php
$yc->query()
    ->user()
    ->auth()
    ->create([
        'login'    => 'login',
        'password' => 'password',
    ]);
```

* `get($request)` - `GET` запрос для получения сущности.

```php
$yc->query()
    ->client()
    ->get()
```

* `update($request)` - `PUT` запрос для обновления сущности.

```php
$yc->query()
    ->client()
    ->get()
    ->update(['name' => 'новое имя клиента'])
```

* `remove($request)` - `DELETE` запрос для удаления сущности.

```php
$yc->query()
    ->client()
    ->get()
    ->remove()
```

### Итерация результатов

Объекты коллекции можно получить с помощью objects().
Таким образом, перебор полученного результата можно организовать следующим образом:

```php
$clients = $yc->query()
    ->clients()
    ->path('company_id', '111111')
    ->param([
        'fields' => [
            'id',
            'name',
            'phone',
            'email',
        ],
    ])
    ->pageSize(200)
    ->page(1)
    ->get();
foreach ($clients->objects() as $client) {
    var_dump($client);
}
```

Однако, если нужно перебрать всю коллекцию, размер которой больше лимита, коллекцию придётся запрашивать несколько раз,
изменяя параметр `page`.
Чтобы не организовывать такой перебор вручную, можно использовать метод `generator()`. Он возвращает генератор,
перебирающий коллекцию с текущего `page` и до последнего элемента (с отправкой новых запросов, если это необходимо).

```php
$generator = $yc->query()
    ->clients()
    ->path('company_id', '111111')
    ->pageSize(200)
    ->generator(function ($builder) {
         $params = $builder->params();
         //Можно прекратить перебор коллекции
         if ($params['page'] > 20) {
             return;
         }
         return $builder->get();
    });
    foreach ($generator as $client) {
        $clients[] = $client;
    }
```