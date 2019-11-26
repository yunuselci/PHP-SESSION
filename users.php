<?php
require_once 'db_connect.php';
session_start();
if(isset($_SESSION['kullaniciadi'])) {
    echo '<h3>Hoş Geldiniz ' . $_SESSION["kullaniciadi"] . '</h3>';
}else {
    header("location:sign_in.php");
}

?>

<input type="button" value="Çıkış Yap" onClick="document.location.href='logout.php'" />
<head>
    <style>
        table, th, td {
            border: 1px solid gray;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
        }
    </style>
</head>

</table>
<table class="table table-striped">
    <thead>
    <tr>
        <th>ID</th>
        <th>Isim</th>
        <th>Soy Isim</th>
        <th>Email</th>
        <th>Bio</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $limit = 5;
    $query = "SELECT * FROM uyelerim";
    $s = $db->prepare($query);
    $s->execute();
    $total_results = $s->rowCount();
    $total_pages = ceil($total_results/$limit);
    if (!isset($_GET['page'])) {
    $page = 1;
    } else{
    $page = $_GET['page'];
    }
    $starting_limit = ($page-1)*$limit;
    $show = "SELECT * FROM uyelerim ORDER BY id ASC LIMIT $starting_limit, $limit";
    $r = $db->prepare($show);
    $r->execute();
    while($res = $r->fetch(PDO::FETCH_ASSOC)):
    ?>
    <tr>
    <td><?php echo $res['id'];?></td>
    <td><?php echo $res['isim'];?></td>
    <td><?php echo $res['soyisim'];?></td>
    <td><?php echo $res['email'];?></td>
    <td><?php echo $res['bio'];?></td>
    </tr>
    <?php
    endwhile;
    for ($page=1; $page <= $total_pages ; $page++):?>
    <a href='<?php echo "?page=$page"; ?>' class="links"><?php echo $page; ?>
    </a>
    <?php endfor; ?>
    </tbody>
</table>
