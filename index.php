<?php
require_once 'db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
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
                    <h3>Hoş Geldiniz</h3>
                </div>
                <div class="card-body">
                    <input type="button" class="g-button" value="Giriş Yap" onClick="document.location.href='sign_in.php'" />
                    <br>
                    <br>
                    <input type="button" value="Üye Ol" class="g-button" onClick="document.location.href='sign_up.php'" />
                    <br>
                    <br>
                    <input type="button" value="To Do" class="send-button" onClick="document.location.href='todos.php'" />
                </div>

            </div>
        </div>
    </div>
</body>

</html>