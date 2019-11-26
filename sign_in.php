<?php
require_once 'db_connect.php';
session_start();

if (isset($_POST['submit'])){
$kullaniciadi = $_POST['kullaniciadi'] ?? null;
$sifre = $_POST['sifre'] ?? null;
if (!$kullaniciadi) {
    echo 'Kullanıcı Adı giriniz!';
} elseif (!$sifre) {
    echo 'Şifre giriniz!';
} else
{
    $query = "SELECT * FROM uyelerim WHERE kullaniciadi = :kullaniciadi AND sifre = :sifre";
    $statement = $db->prepare($query);
    $statement->execute(
        array(
            'kullaniciadi'     =>     $_POST["kullaniciadi"],
            'sifre'     =>     $_POST["sifre"]
        )
    );
    $count = $statement->rowCount();
    if($count > 0)
    {
        $_SESSION["kullaniciadi"] = $_POST["kullaniciadi"];
        header("location:users.php");
    }
    else
    {
        $message = '<label>Wrong Data</label>';
        echo $message;
    }
}
}


?>

<form action="" method="post">
    Kullanıcı Adı:<br>
    <input type="text" name="kullaniciadi">
    <br>
    Şifre:<br>
    <input type="password" name="sifre">
    <br>
    <input type="hidden" name="submit" value="1">
    <button type="submit">Giriş Yap</button>
    <input type="button" value="Üye Ol" onClick="document.location.href='sign_up.php'" />

</form>
