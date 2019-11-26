<?php
require_once 'db_connect.php';
/*<-- Kullanıcının boşlukları tam doldurup doldurmadığı alınır --> */
if (isset($_POST['submit'])) {
    $kullaniciadi = $_POST['kullaniciadi'] ?? null;
    $sifre = $_POST['sifre'] ?? null;
    $isim = $_POST['isim'] ?? null;
    $soyisim = $_POST['soyisim'] ?? null;
    $email = $_POST['email'] ?? null;
    $bio = $_POST['bio'] ?? null;
    $error_messages = [];
    if (!$kullaniciadi) {
        array_push($error_messages, "Kullanıcı Adı");
    } if (!$sifre) {
        array_push($error_messages, "Şifre");
    } if (!$isim) {
        array_push($error_messages, "İsim");
    } if (!$soyisim) {
        array_push($error_messages, "Soy İsim");
    } if (!$email) {
        array_push($error_messages, "Email");
    } if (!$bio) {
        array_push($error_messages, "Bio");
    } if (!$kullaniciadi || !$sifre || !$isim || !$soyisim || !$email || !$bio){
        /*$length = count($error_messages);
        for($i=0; $i<$length; $i++){
            echo $error_messages[$i]." Girmediniz".'<br>';
        }*/
        foreach ($error_messages as $value) {
            echo $value . ' Girmediniz<br>';
        }
    }elseif (!filter_var( $email ,FILTER_VALIDATE_EMAIL)){
        echo 'Geçerli Bir E-Posta Girmediniz!';
    }else {
        $query = $db->prepare('INSERT INTO uyelerim SET  
        kullaniciadi = ?,
        sifre = ?,
        isim = ?,
        soyisim = ?,
        email = ?,
        bio = ?');
        $check_username_result = $db->query("SELECT * FROM uyelerim WHERE kullaniciadi='$kullaniciadi' LIMIT 1");
        $check_username = $check_username_result->fetch()['kullaniciadi'];
        $check_email_result = $db->query("SELECT * FROM uyelerim WHERE email='$email' LIMIT 1");
        $check_email = $check_email_result->fetch()['email'];
        if ($_POST['kullaniciadi'] === $check_username || $_POST['email'] === $check_email) {
            echo "<h3>" . "Kullaniciadi veya Email zaten kayıtlı." . "</h3>";
        } else {
            $insert = $query->execute([$kullaniciadi, $sifre, $isim, $soyisim, $email, $bio]);
            if ($insert) {
                header('Location:index.php');
            } else {
                $error = $query->errorInfo();
                echo 'MySQL Hatası: ' . $error[2];
            }
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