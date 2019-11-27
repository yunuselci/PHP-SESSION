<?php
require_once "db_connect.php";
function post($name)
{
    if (isset($_POST[$name]))
        return $_POST[$name];
}
if (post('ekle')) {
    $v_yapilacak = $_POST['yapilacak'] ?? null;
    if (!$v_yapilacak) {
        echo 'Yapılacak Giriniz!';
    } else {
        $query = $db->prepare('INSERT INTO todos SET 
        yapilacak =?,
        is_checked=0');
        $insert = $query->execute([$v_yapilacak]);
        if ($insert) {
            echo '<h3>' . "Ekleme işlemi başarılı." . '<h3>';
        } else { // Insert yaparken hata alırsak, error mesajı.
            $error = $query->errorInfo();
            echo 'MySQL Hatası: ' . $error[2];
        }
    }
}
if (post('sil')) {
    $id = $_POST['id'];
    $query = $db->prepare("DELETE FROM todos WHERE id = :id");
    $query->execute([
        "id" => $id
    ]);
    header('Location:todos.php');
}
if (post('checked')) {
    $id = $_POST['id'];
    $is_checked = 1;
    $query = $db->prepare("UPDATE todos SET is_checked=:is_checked WHERE id =:id");
    $query->execute([
        "id" => $id,
        "is_checked" => $is_checked
    ]);
}
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

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
            <div class="card2">
                </table>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="color:white">Yapilacak</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="input-group form-group">

                                    <form action="" method="post">
                                        <input type="text" class="form-control" name="yapilacak" placeholder="Yapılacak">
                                        <input type="hidden" name="ekle" value="1">
                                        <button type="submit" class="btn login_btn">Ekle</button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                </table>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="color:white">Yapılacaklar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <td><?php
                            $show = 'SELECT * FROM todos WHERE is_checked=0';
                            $r = $db->prepare($show);
                            $r->execute();
                            while ($res = $r->fetch(PDO::FETCH_ASSOC)) :
                                ?>
                                <tr>
                                    <td style="color:white"><?php echo $res['yapilacak']; ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="sil" value="1">
                                            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                                            <button type="submit" class="btn login_btn">Sil</button>
                                        </form>
                                        <form action="" method="post">
                                            <input type="hidden" name="checked" value="1">
                                            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                                            <button type="submit" class="btn login_btn">Yapıldı</button>
                                    </td>
                                    </form>

                                </tr>
                            <?php endwhile; ?>
                        </td>

                    </tbody>
                </table>
                <hr>
                </table>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="color:white">Yapılanlar</th>
                        </tr>
                    </thead>
                    <tbody>

                        <td><?php
                            $show = 'SELECT * FROM todos WHERE is_checked=1';
                            $r = $db->prepare($show);
                            $r->execute();
                            while ($res = $r->fetch(PDO::FETCH_ASSOC)) :
                                ?>
                                <tr>
                                    <td style="color:white"><?php echo $res['yapilacak']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </td>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>