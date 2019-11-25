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
    $getUsers = $db->prepare("SELECT * FROM uyelerim ORDER BY id ASC");
    $getUsers->execute();
    while(    $users = $getUsers->fetch()){
        echo "<tr>".
            "<td>".$users["id"]."</td>".
            "<td>".$users["isim"]."</td>".
            "<td>".$users["soyisim"]."</td>".
            "<td>".$users["email"]."</td>".
            "<td>".$users["bio"]."</td>".
            "</tr>";
    }
    ?>

    </tbody>
</table>