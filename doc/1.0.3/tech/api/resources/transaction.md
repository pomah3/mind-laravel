# Объект Transaction

- [Схема](#scheme)
- [Пример](#example)

<a name="scheme"></a>
## Схема

```json
{
    "id": Int,
    "from": User|null,
    "to": User,
    "points": Int,
    "cause": Cause,
    "created_at": String
}
```

См. объект [Cause](cause)

<a name="example"></a>
## Пример

```json
{  
    "id":3474,
    "from":null,
    "to":{  
        "id":"25",
        "given_name":"\u0414\u0430\u043d\u0438\u044d\u043b\u044c",
        "family_name":"\u0411\u0430\u0439\u0440\u0430\u043c\u043e\u0432",
        "father_name":"\u0424\u0430\u0438\u043b\u044c\u0435\u0432\u0438\u0447",
        "type":"student",
        "locale":"ru",
        "email":null,
        "roles":[  

        ],
        "group":"10-1",
        "points":100
    },
    "points":100,
    "cause":{  
        "id":1,
        "title":"\u041d\u0430\u0447\u0430\u043b\u044c\u043d\u044b\u0435 \u0431\u0430\u043b\u043b\u044b",
        "points":100,
        "access":[  
            "not",
            "all"
        ],
        "category":""
    },
    "created_at":"2019-03-14 12:25:17"
}
```
