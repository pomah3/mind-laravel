# API

Для работы внешних приложений, таких как [Android-приложение][android], Mind предоставляет *закрытое* API.

- [Общий вид запроса](#request)
- [Доступные методы](#methods)

<a name="request"></a>
## Общий вид запроса

Для работы с API используются `GET`, `POST`, `DELETE` и прочие методы HTTP. Общий вид адреса:

```http
http://mind-itl-kfu.ru/api/{метод}?token={токен}
```

Токен можно получить у администратора.

Ответ даётся в виде **json**.

<a name="methods"></a>
## Доступные методы

Группы методов:

- [users](users)
- [transactions](transactions)
- [causes](causes)
- [groups](groups)
- [timetable](timetable)

[android]: https://github.com/habur331/mind
