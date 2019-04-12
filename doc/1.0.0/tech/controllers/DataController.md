# DataController

> [Исходный код][source]

- [Методы](#methods)

<a name="methods"></a>
## Методы

### `index`

Возвращает страницу загрузки данных. Политика - `"view-data"` 

### `upload`

Загружает данные. Политика - `"upload-data"`.

Параметры POST-запроса:

```php
[
    "file" => "required|mimes:xls,xlsx,zip", // загружаемый документ
    "data-type" => "required" // тип ридера, который будет использоваться для обработки данных
]
```


[source]: https://github.com/pomah3/mind-laravel/blob/master/app/Http/Controllers/DataController.php
