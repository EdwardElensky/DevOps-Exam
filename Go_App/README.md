### How it work:

1. Первая строка package main — декларирует, что код в файле main.go принадлежит главному пакету. После этого мы импортировали пакет net/http, который предоставляет реализации клиента и сервера HTTP для использования в нашем приложении. Этот пакет является частью стандартной библиотеки и входит в каждую установку Go.

2. В функции main, http.NewServeMux() создает новый мультиплексор HTTP-запросов и присваивает его переменной mux. По сути, мультиплексор запросов сопоставляет URL-адрес входящих запросов со списком зарегистрированных путей и вызывает соответствующий обработчик для пути всякий раз, когда найдено совпадение.

3. Далее мы регистрируем нашу первую функцию-обработчик для корневого пути /. Эта функция-обработчик является вторым аргументом для HandleFunc и всегда имеет сигнатуру func (w http.ResponseWriter, r * http.Request).

4. Если вы посмотрите на функцию indexHandler, вы увидите, что она имеет именно такую сигнатуру, что делает ее действительным вторым аргументом для HandleFunc. Параметр w — это структура, которую мы используем для отправки ответов на HTTP-запрос. Она реализует метод Write(), который принимает слайс байтов и записывает объединенные данные как часть HTTP-ответа.

5. С другой стороны, параметр r представляет HTTP-запрос, полученный от клиента. Это то, как мы получаем доступ к данным, отправляемым веб-браузером на сервере. Мы еще не используем его здесь, но будем использовать его позже.

6. Наконец, у нас есть метод http.ListenAndServe(), который запускает сервер на порту 3000, если порт не установлен окружением. Не стесняйтесь использовать другой порт, если 3000 используется на вашем компьютере.

### How it RUN:
1. Cкомпилируйте и выполните код:
```
go run hello/main.go
```
2. Если вы перейдете на http://localhost:3000 в своем браузере, вы должны увидеть текст «Hello World 5!».
3. yes, it is all :)
