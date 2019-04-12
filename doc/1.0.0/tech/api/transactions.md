# Transactions

- [Все транзакции](all)
- [Одна транзакция](one)
- [Транзакции пользователя](of_user)
- [Добавить транзакцию](add)

<a name="all"></a>
## Все транзакции

```http
GET /transactions
```

### Возвращаемые значения

Возвращает массив объектов типа [`Transaction`](resources/transaction).

<a name="one"></a>
## Одна транзакция

```http
GET /transactions/{id}
```

### Возвращаемые значения

Возвращает объект типа [`Transaction`](resources/transaction).

<a name="of_user"></a>
## Транзакции пользователя

```
GET /transaction/of_user/{id}
```

Возвращает все транзакции, которые отправил или получил пользователь с логином `id`.

### Возвращаемые значения

Возвращает массив объектов типа [`Transaction`](resources/transaction).

<a name="add"></a>
## Добавить транзакцию

```
POST /transaction/{from}/{to}/{cause}/{points?}
```

### Параметры

`from` - логин отправителя
`to` - логин получателя
`cause` - id причины
`points` - количество баллов. По умолчанию - баллы причины.

### Возвращаемые значения

Возвращает созданную транзакцию или объект ошибки (код `403`):
```json
{
    "error": "not allowed"
}
```
