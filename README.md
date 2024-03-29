# Тестовое задание для via-mobi.ru
## Задание
Проект рассчитан на выкладку в корень сайта http://localhost/

При этом есть три различных варианта настроек проекта:
- http://localhost/
- http://localhost/brand1
- http://localhost/brand2

Тестовое задание:
1. Доработайте проект так, чтобы класс Config не допускал возможности
 создания нескольких экземпляров;
1. Доработайте проект так, чтобы подписка в каждом из различных
 вариантов настроек была независима;
1. При попытке подписаться в brand2 тестеры получают ошибку -
 бесконечные редиректы, исправьте ошибку;
1. Доработайте проект так, чтобы исключить подобные (п.3) ошибки при
 добавлении новых вариантов настроек;
1. Доработайте проект так, чтобы запрос на несуществующую ссылку не
 приводил к PHP Fatal error;
1. Что в целом можете сказать про код, который пришлось править?
 (Напишите пару предложений в ответ);
1. Пришлите в ответ архив с git-репозиторием, в котором каждый пункт
 тестового задания выполнен отдельным коммитом.

P.S. Если в процессе анализа кода проекта или его доработок встретятся
 какие то огрехи, явно требующие исправления - исправьте отдельным
  коммитом.

## Решение
> Доработайте проект так, чтобы подписка в каждом из различных вариантов
> настроек была независима;

Сложно понять требование, варинатов как бы три, а конфигов как бы 4, но
 один дефолтный и всегда мержиться, но всё равно вопрос, считать ли
 дефолт отдельным вариантом
 
В итоге был реализована логика для двух варинатов и одно поведение по
 умолчанию
 
В соответствии с духом зания, но не совсем в соответствии с буквой 

> Доработайте проект так, чтобы исключить подобные (п.3) ошибки при
> добавлении новых вариантов настроек;

Был придуман спорный костыль, но с практической точки зрения безупречное
 решение, с точки зрения "решения в общем виде" так себе идея

> Доработайте проект так, чтобы запрос на несуществующую ссылку не
> приводил к PHP Fatal error;

Для себя транслировал это требование в выдачу ошибки 404 (или типа того)

> Что в целом можете сказать про код, который пришлось править?
> (Напишите пару предложений в ответ);

Написано красиво, но упор сделан на динамику, что во первых затрудняет
 навигацию по коду, во вторых убивает статический анализ в корне.
 
То есть имеем махровое legacy (наследние от предыдущих поколений
 разработчиков), с которым если не знаком, то плачешь горючими слезами
 
Те же индексы массивов везде литералы, ни одной константы, то есть вот
 взять и поменять сложненько, ищи все места и все вручную исправляй
 
Или повсеместное использование фабрики (как бы синглтон), хочешь понять
 что делает метод ? Найди файл класса вручную, найди в файле описание
 метода, а потом уже кури сам метод.
 
Я пишу не так. Но для микросервиса, наверное норм стиль :)

> Пришлите в ответ архив с git-репозиторием, в котором каждый пункт
> тестового задания выполнен отдельным коммитом.

Кажется требование про архив утратило актуальность, сколько то поколения
 назад.
 
Каждый пункт задания выполнен отдельным камитом, смотрите историю камтов

> P.S. Если в процессе анализа кода проекта или его доработок встретятся
> какие то огрехи, явно требующие исправления - исправьте отдельным
> коммитом.

После пяти часов костылинга наводить красоту в чужом коде не хочется.

Что бы что то исправлять надо хорошо отличать ошибку от авторского
 исполнения, может быть в моих глазах баг, а в глазах автора фича ? 
 
Не имея понятия о "стандартах кодирования" и требованиях к коду, что то
 там ломать и крушть не камильфо.
 
Хотя бы авто-тесты были :) было бы уже не так страшно в омут с головой..
