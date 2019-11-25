<?php
$db = new PDO('mysql:host=localhost;dbname=uyeler', 'root', '');
$db->exec("SET CHARSET UTF8"); // Türkçe karakter için UTF8
?>