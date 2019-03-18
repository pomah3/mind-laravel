# Users

- [Все пользователи](#all)
- [Один пользователь](#one)
- [Вход](#signin)
- [Вход через edu.tatar](#signin-edutatar)

<a name="all"></a>
## Все пользователи

```http
GET users
```

### Возвращаемые значения

Возвращает массив объектов типа [`User`](resources/user)

### Пример ответа

```json
[  
   {  
      "id": "1",
      "given_name": "Admin",
      "family_name": "Adminov",
      "father_name": "Adminovich",
      "type": "teacher",
      "locale": "ru",
      "email": null,
      "roles": [  
         {  
            "role": "admin",
            "role_arg": null
         }
      ]
   }
]
```

<a name="one"></a>
## Один пользователь

```http
GET users/{id}
```

### Возвращаемые значения

Возвращает объект типа [`User`](resources/user)

### Пример ответа

```http
GET users/1
```

```json  
{  
  "id": "1",
  "given_name": "Admin",
  "family_name": "Adminov",
  "father_name": "Adminovich",
  "type": "teacher",
  "locale": "ru",
  "email": null,
  "roles": [  
     {  
        "role": "admin",
        "role_arg": null
     }
  ]
}
```

<a name="signin"></a>
## Вход

```http
GET users/check/{login}/{password}
```

### Возвращаемые значения

```json
{
    "data": Bool
}
```

### Пример ответа

```json
{
    "data": false
}
```

<a name="signin-edutatar"></a>
## Вход через edu.tatar

```http
GET users/check/edu/{login}/{password}
```

### Возвращаемые значения

```json
{
    "data": Bool,
    "id": String
}
```

### Пример ответа

```json
{
    "data": true,
    "id": 70
}
```
