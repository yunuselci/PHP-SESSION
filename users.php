<?php
require_once 'db_connect.php';
session_start();
if (isset($_SESSION['kullaniciadi'])) {
    //echo '<div class="card-header">' . '<h3>' . "Hoş Geldin " . $_SESSION['kullaniciadi'] . '</h3>' . '</div>';
} else {
    header("location:sign_in.php");
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
            <div class="card2">
                <div class="card-header">
                    <h3>Hoş Geldinin <?php echo $_SESSION['kullaniciadi']?></h3>
                </div>
                </table>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="color:white">ID</th>
                            <th style="color:white">Isim</th>
                            <th style="color:white">Soy Isim</th>
                            <th style="color:white">Email</th>
                            <th style="color:white">Bio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $limit = 5;
                        $query = "SELECT * FROM uyelerim";
                        $s = $db->prepare($query);
                        $s->execute();
                        $total_results = $s->rowCount();
                        $total_pages = ceil($total_results / $limit);
                        if (!isset($_GET['page'])) {
                            $page = 1;
                        } else {
                            $page = $_GET['page'];
                        }
                        $starting_limit = ($page - 1) * $limit;
                        $show = "SELECT * FROM uyelerim ORDER BY id ASC LIMIT $starting_limit, $limit";
                        $r = $db->prepare($show);
                        $r->execute();
                        while ($res = $r->fetch(PDO::FETCH_ASSOC)) :
                            ?>
                            <tr>
                                <td style="color:white"><?php echo $res['id']; ?></td>
                                <td style="color:white"><?php echo $res['isim']; ?></td>
                                <td style="color:white"><?php echo $res['soyisim']; ?></td>
                                <td style="color:white"><?php echo $res['email']; ?></td>
                                <td style="color:white"><?php echo $res['bio']; ?></td>
                            </tr>
                        <?php
                        endwhile;
                        for ($page = 1; $page <= $total_pages; $page++) : ?>
                            <a href='<?php echo "?page=$page"; ?>' class="btn float login_btn"><?php echo $page; ?>
                            </a>
                        <?php endfor; ?>
                    </tbody>
                </table>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <a href="logout.php">Çıkış Yap</a>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>