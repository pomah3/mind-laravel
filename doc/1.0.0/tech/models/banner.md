# Banner

> [Исходный код][source]

- [Поля](#fields)
- [Переопределения](#overriding)

<a name="field"></a>
## Поля

Тип поля | Поле | Описание
-|-|-
`increments` | `id` | 
`string` | `img_path` | Путь до изображения баннера
`string` | `link` | Ссылка, на которую ведёт баннер
`string` | `alt` | alt-параметр изображения баннера
`date` | `from_date` | Дата начала показа баннера, показывается включительно
`date` | `till_date` | Дата окончания показа баннера, показывается включительно

<a name="overriding"></a>
## Переопределения

При удалении модели (`deleting`) удаляется и файл картинки баннера.

[source]: https://github.com/pomah3/mind-laravel/blob/master/app/Banner.php
