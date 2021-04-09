### 1. Что делает код hello.java ?

Это код нашего сервлета. 
```
package com.example;
 
import java.io.IOException;
import java.io.PrintWriter;
 
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
 
public class hello extends HttpServlet {
 
    public void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        resp.setContentType("text/html;charset=utf-8");
 
        PrintWriter pw = resp.getWriter();
        pw.println("<H2>Hello World 2!</H2>");
 
    }
}
```
* Мы создаем наследника класса HttpServlet. 
* В нем реализуем один метод doGet(), 
* В методе сначала сообщаем что сервлет будет выдавать html документ. 
* Потом вытаскиваем из resp ссылку на экземпляр PrintWriter. 
* То, что написано в нем, будет отдано сервером на запрос от клиента.

####  
Cервлет нужно скомпилировать в байт-код и уже с сгенерированным hello.class работать.</br>
Класс наследуется от HttpServlet. И для компиляции программы нам будет нужен jar файл с нужными классами внутри.</br>
В папке Tomcat есть папка lib. В ней есть файл servlet-api.jar </br>
Копируем его в нашу папку с java файлом.</br>
И запустим сборку. (Если в системной переменной Path не прописан путь к JDK то команда не сработает.)
```
javac -encoding UTF-8 -cp servlet-api.jar "/home/user/DevOps-Exam/Java_App/com/example/hello.java"
```
Если эта команда не сработает используйте один из этих вариантов: </br>
```
javac -encoding UTF-8 -cp .;servlet-api.jar com/example/*.java 
```
or
```
javac -classpath servlet-api.jar com/example/hello.java
```
or
```
javac -encoding UTF-8 -cp servlet-api.jar com/example/*.java 
```
в папке с hello.java файлом появится файл hello.class

Собираем web-приложение:</br> 
Перейдем в папку /opt/Tomcat. Там есть папка webapps.</br> 
В папке webapps создадим папку с названием web-приложения. Допустим, helloapp.</br> 
В этой папке создайте папку WEB-INF, а в ней папку classes.</br> 
/opt/Tomcat/webapps/helloapp/WEB-INF/classes </br> 

В папке classes у нас должны находиться файлы бай-кода наших классов.</br> 
То есть тут должен появится файл hello.class. Но мы помним, что класс был определен в пакете com.example.</br> 
Поэтому в папке classes создаем папку com, а ней папку example.</br> 
И уже в эту папку кидаем файл hello.class.</br> 
/opt/Tomcat/webapps/helloapp/WEB-INF/classes/com/example/hello.class</br> 

Перейдем в папку WEB-INF. В ней создадим текстовой файл web.xml с таким содержанием: </br> 
```
<!DOCTYPE web-app PUBLIC '-//Sun Microsystems, Inc.//DTD
  Web Application 2.3//EN' 'http://java.sun.com/dtd/web-app_2_3.dtd'>
 
<web-app>
 
  <servlet>
    <servlet-name>test</servlet-name>
    <servlet-class>com.example.hello</servlet-class>
  </servlet>
 
  <servlet-mapping>
    <servlet-name>test</servlet-name>
    <url-pattern>/test</url-pattern>
  </servlet-mapping>
 
</web-app>
```
В тэге servlet-class мы указываем запускаемый класс сервлета, а в тэге url-pattern указываем url имя запускаемого сервлета.</br> 

Обязательно перезапустите сервер!</br> 

Всё сборка прошла успешно. Теперь можем проверить работу web-приложения. </br> 
Для этого переходим по адресу: http://localhost:8080/hello/test . </br> 

! B адресе hello — это имя папки нашего приложения из папки webapps</br> 
! test — имя сервелета из тэга url-pattern из файла web.xml.</br> 


### how update and run the java-app

1. delete  /home/user/DevOps-Exam/Java_App/com/example/hello.class
2. edit file  /home/user/DevOps-Exam/Java_App/com/example/hello.java
3. compilation of class file: run javac -encoding UTF-8 -cp servlet-api.jar "/home/user/DevOps-Exam/Java_App/com/example/hello.java"
4. add the new class file in tomcat: copy /home/user/DevOps-Exam/Java_App/com/example/hello.class in /opt/tomcat/webapps/helloapp/WEB-INF/classes/com/example/
5. restart tomcat:  sudo systemctl restart tomcat
6. check java-app in your browser: http://localhost:8080/helloapp/test



