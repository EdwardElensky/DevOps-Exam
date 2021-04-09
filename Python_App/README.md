#### Что делает этот код?

* Импортируем класс Flask. Экземпляр этого класса будет WSGI-приложением.
* Создаём экземпляр этого класса. Первый аргумент - это имя модуля или пакета приложения.
* Используем декоратор route(), чтобы сказать Flask, какой из URL должен запускать нашу функцию.
(Функция, которой дано имя, используемое также для генерации URL-адресов для этой конкретной функции, возвращает сообщение, которое мы хотим отобразить в браузере пользователя.)
* Для запуска локального сервера с нашим приложением используем функцию run(). 
####
Благодаря конструкции if __name__ == '__main__' сервер запустится вызове скрипта из интерпретатора Python.
Кроме того:
* разрешаем взаимодействовать не только с локалхостом
* отключаем отладку
* при желании можем изменить порт. 
