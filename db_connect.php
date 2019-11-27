<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=uyeler', 'root', '');
    $db->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'"); // Türkçe karakter için UTF8
} catch (PDOException $error) {
    echo $error->getMessage();
}
