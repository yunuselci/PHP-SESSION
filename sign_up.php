<?php
require_once 'db_connect.php';

/*<-- Kullanıcının boşlukları tam doldurup doldurmadığı alınır --> */
if(isset($_POST['submit'])){
    $kullaniciadi = $_POST['kullaniciadi'] ?? null;
    $sifre = $_POST['sifre'] ?? null;
    $isim = $_POST['isim'] ?? null;
    $soyisim = $_POST['soyisim'] ?? null;
    $email = $_POST['email'] ?? null;
    $bio = $_POST['bio'] ?? null;
    if (!$kullaniciadi) {
        echo 'Kullanıcı Adı giriniz!';
    } elseif (!$sifre) {
        echo 'Şifre giriniz!';
    }elseif (!$isim){
        echo 'Isim giriniz!';
    }elseif (!$soyisim){
        echo 'Soyisim giriniz!';
    }elseif (!$email){
        echo 'E-mail giriniz!';
    }elseif(!$bio){
        echo 'Bio giriniz!';
    }else{
        $query = $db -> prepare('INSERT INTO uyelerim SET  
        kullaniciadi = ?,
        sifre = ?,
        isim = ?,
        soyisim = ?,
        email = ?,
        bio = ?'); //SQL Injection'u engelleme amaçlı bu şekilde bir kullanım yaptım
        $insert = $query->execute([$kullaniciadi,$sifre,$isim,$soyisim,$email,$bio]);
    if($insert){
        header('Locatin:index.php');
    }else{ // Insert yaparken hata alırsam daha düzgün görünsün diye böyle bir kullanım yaptım
        $error = $query->errorInfo();
        echo 'MySQL Hatası: ' . $error[2];
    }
    }
}

?>

<form action="" method="post">
    Kullanıcı Adı: <br>
    <input type="text" name="kullaniciadi">
    <br>
    Şifre:<br>
    <input type="password" name="sifre">
    <br>
    İsim:<br>
    <input type="text" name="isim">
    <br>
    Soyisim:<br>
    <input type="text" name="soyisim">
    <br>
    E-mail:<br>
    <input type="email" name="email">
    <br>
    Bio:<br>
    <textarea name="bio" rows="10" cols="22">Hakkımda..</textarea>
    <br>
    <input type="hidden" name="submit" value="1">
    <button type="submit">Kayıt Ol</button>
    <input type="button" value="Tarayiciniz Yönlendirmedi mi ? Giriş Yap" onClick="document.location.href='sign_in.php'" />


</form>
