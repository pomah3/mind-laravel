# Роутинг

- [Вход](#signin)
- [Локаль](#locale)
- [Баллы](#points)
- [Расписание](#timetable)
- [Группы](#groups)
- [Вопросы](#questions)
- [Баннеры](#banners)
- [Пользователи](#users)
- [Мероприятия](#events)
- [Документы](#documents)
- [Голосования](#polls)
- [Настройки](#settings)
- [Данные](#data)
- [Уведомления](#notifications)
- [Оценки](#marks)
- [Почта](#email)
- [Статус учеников](#status)

<a name="#signin"></a>
## Вход

Контроллер - [`App\Http\Controllers\SigninController`](controllers/SigninController)

Метод | Url | Action | Описание
-|-|-
GET  | /signin | index | Отображает страницу входа
POST | /signin | enter | Заходит на сайт под данным логином и паролем

<a name="#locale"></a>
## Локаль

Контроллер - [`App\Http\Controllers\LocaleController`](controllers/LocaleController)

Метод | Url | Action | Описание
-|-|-
GET  | /setlocale/{locale} | set | Меняет локаль пользователя

<a name="#points"></a>
## Баллы

Контроллер - [`App\Http\Controllers\PointsController`](controllers/PointsController)

Метод | Url | Action | Описание
-|-|-
GET  | /points/add | add_index | Показывает страницу добавления баллов
POST  | /points/add | add | Добавляет баллы
GET  | /points/add | add | Добавляет баллы
GET  | /points/ | mine | Показывает баллы пользователя
GET  | /points/give | give_index | Показывает страницу перевода баллов
POST  | /points/give | give | Переводит баллы
GET  | /points/{student} | of_student | Показывает баллы ученика

<a name="#timetable"></a>
## Расписание

Контроллер - [`App\Http\Controllers\TimetableController`](controllers/TimetableController)

Метод | Url | Action | Описание
-|-|-
GET  | /timetable | show | Показывает расписание текущего ученика

<a name="#groups"></a>
## Группы

Контроллер - [`App\Http\Controllers\GroupController`](controllers/GroupController)

Метод | Url | Action | Описание
-|-|-
GET  | /groups | all | Показывает все группы
GET  | /groups/{group} | get | Показывает данную группу
GET  | /groups/mine | get_default | Показывает группу текущего пользователя


<a name="#questions"></a>
## Вопросы

Контроллер - [`App\Http\Controllers\QuestionController`](controllers/QuestionController)

Метод | Url | Action | Описание
-|-|-
GET  | /questions | show | Показывает все вопросы
POST  | /questions/store | store | Добавляет вопрос
POST  | /questions/answer/{question} | answer | Отправляет ответ на вопрос
DELETE  | /questions/{question} | delete | Удаляет вопрос


<a name="#banners"></a>
## Баннеры

Контроллер - [`App\Http\Controllers\BannerController`](controllers/BannerController)

Использует resource роутинг.

<a name="#users"></a>
## Пользователи

<a name="#events"></a>
## Мероприятия


<a name="#documents"></a>
## Документы


<a name="#polls"></a>
## Голосования


<a name="#settings"></a>
## Настройки


<a name="#data"></a>
## Данные


<a name="#notifications"></a>
## Уведомления


<a name="#marks"></a>
## Оценки


<a name="#email"></a>
## Почта


<a name="#status"></a>
## Статус учеников


