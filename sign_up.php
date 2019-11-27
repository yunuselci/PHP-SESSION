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
    }
    if (!$sifre) {
        array_push($error_messages, "Şifre");
    }
    if (!$isim) {
        array_push($error_messages, "İsim");
    }
    if (!$soyisim) {
        array_push($error_messages, "Soy İsim");
    }
    if (!$email) {
        array_push($error_messages, "Email");
    }
    if (!$bio) {
        array_push($error_messages, "Bio");
    }
    if (!$kullaniciadi || !$sifre || !$isim || !$soyisim || !$email || !$bio) {
        /*$length = count($error_messages);
        for($i=0; $i<$length; $i++){
            echo $error_messages[$i]." Girmediniz".'<br>';
        }*/
        foreach ($error_messages as $value) {
            echo '<div class="alert alert-danger" role="alert">' . $value . ' Girmediniz<br>' . '</div>';
        }
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Geçerli Bir E-Posta Girmediniz!';
    } else {
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
            echo '<div class="alert alert-danger" role="alert">' . "Kullaniciadi veya Email zaten kayıtlı." . '</div>';
        } else {
            $insert = $query->execute([$kullaniciadi, $sifre, $isim, $soyisim, $email, $bio]);
            if ($insert) {
                header('Location:index.php');
            } else {
                $error = $query->errorInfo();
                $dosya = fopen('errors.txt', 'a');
                fwrite($dosya, $error[2]);
                fclose($dosya);
                echo 'Bir şeyler ters gitti.';
            }
        }
    }
}

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>

<head>
    <title>Sign Up Page</title>
    <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Kayıt Ol</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="kullaniciadi" placeholder="Kullanıcı Adı">
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" name="sifre" placeholder="Şifre">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <input type="text" class="form-control" name="isim" placeholder="İsim">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <input type="text" class="form-control" name="soyisim" placeholder="Soyisim">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="E-Mail">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-heart"></i></span>
                            </div>
                            <input type="text" name="bio" class="form-control" placeholder="Bio">
                        </div>
                        <div class="row align-items-center remember">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Kayıt Ol" class="btn float-right login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <a href="sign_in.php">Giriş Yap</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>