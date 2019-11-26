<?php
require_once 'db_connect.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Hoş Geldiniz</h3>
    <input type="button" value="Giriş Yap" onClick="document.location.href='sign_in.php'" />
    <input type="button" value="Üye Ol" onClick="document.location.href='sign_up.php'" />
    <input type="button" value="To Do" onClick="document.location.href='todos.php'" />

</body>

</html>