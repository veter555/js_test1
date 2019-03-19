<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body style="text-align: center;">
        <h1 style="color: red;">ТЕСТИРОВАННИЕ ГЕТ И ПОСТ ЗАПРОСОВ</h1>
        <p><a href="/curl.php?method=get&site=http://veter.vv&param1=abc&param2=abc2&param3=abc6">Get правильный запрос(все поля заполнены)</a></p>
        <p><a href="/curl.php?method=get&param1=abc&param2=abc2&param3=abc6">Get без поля сайт</a></p>
        <p><a href="/curl.php?&site=http://veter.vv&param1=abc&param2=abc2&param3=abc6">Get без поля метода</a></p>
        <p><a href="/curl.php?method=get&site=http://veter.vv">Get без передачи парметров</a></p>
        <p><a href="/curl.php?">Get без всех значений</a></p>
        </br>
        <p><a href="/curl.php?method=post&site=http://veter.vv&param1=abc&param2=abc2&param3=abc6">Post правильный запрос(все поля заполнены)</a></p>
        <p><a href="/curl.php?method=post&param1=abc&param2=abc2&param3=abc6">Post без поля сайт</a></p>
        <p><a href="/curl.php?&site=http://veter.vv&param1=abc&param2=abc2&param3=abc6">Post без поля метода</a></p>
        <p><a href="/curl.php?method=post&site=http://veter.vv">Post без передачи парметров</a></p>
        <p><a href="/curl.php?">Post без всех значений</a></p>
    </body>
</html>
