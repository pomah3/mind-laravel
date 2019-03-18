# Объект User 

- [Схема](#scheme)
- [Пример](#example)

<a name="scheme"></a>
## Схема

```json
{
    "id": String,
    "email": String|null,
    "type": "teacher"|"student",

    "given_name": String,
    "family_name": String,
    "father_name": String,

    "locale": "ru"|"tt"|"en",
    "roles": [
        {
            "role": String,
            "role_arg": String|null
        }
    ],

    "group": String?,
    "points": Int?
}
```

Поля `group` и `points` появляются только в том случае, если `type` выставлен в `"student"`

<a name="example"></a>
## Пример

```json
{  
  "id": "35",
  "given_name": "\u041c\u0430\u043a\u0441\u0438\u043c",
  "family_name": "\u0422\u0440\u043e\u0444\u0438\u043c\u043e\u0432",
  "father_name": "\u0414\u043c\u0438\u0442\u0440\u0438\u0435\u0432\u0438\u0447",
  "type": "student",
  "locale": "ru",
  "email": null,
  "roles": [],
  "group": "10-1",
  "points": 100
}
```
