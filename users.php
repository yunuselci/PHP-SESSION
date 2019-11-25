<?php
session_start();
if(isset($_SESSION['kullaniciadi'])) {
    echo '<h3>Hoş Geldiniz' . $_SESSION["kullaniciadi"] . '</h3>';

}

?>

<input type="button" value="Çıkış Yap" onClick="document.location.href='logout.php'" />
