# Объект Transaction

- [Схема](#scheme)
- [Пример](#example)

<a name="scheme"></a>
## Схема

```json
{
    "id": Int,
    "title": String,
    "points": Int,
    "access": Access,
    "category": String
}
```

См. объект [Cause](cause)

<a name="example"></a>
## Пример

```json
{  
    "id":1,
    "title":"\u041d\u0430\u0447\u0430\u043b\u044c\u043d\u044b\u0435 \u0431\u0430\u043b\u043b\u044b",
    "points":100,
    "access":[  
        "not",
        "all"
    ],
    "category":"\u041e\u043b\u0438\u043c\u043f\u0438\u0430\u0434\u043d\u043e\u0435 \u0434\u0432\u0438\u0436\u0435\u043d\u0438\u0435"
},
```
