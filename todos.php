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
if (post('checked'))
    $id = $_POST['id'];
$is_checked = 1;
$query = $db->prepare("UPDATE todos SET is_checked=:is_checked WHERE id =:id");
$query->execute([
    "id" => $id,
    "is_checked" => $is_checked
]);
?>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid gray;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 15px;
        }
    </style>
</head>
</table>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Yapilacak</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <form action="" method="post">
                    <input type="text" name="yapilacak">
                    <input type="hidden" name="ekle" value="1">
                    <button type="submit">Ekle</button>
                </form>
            </td>
        </tr>
    </tbody>
</table>
<hr>
</table>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Yapılacaklar</th>
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
                    <td><?php echo $res['yapilacak']; ?>
                        <form action="" method="post">
                            <input type="hidden" name="sil" value="1">
                            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                            <button type="submit">Sil</button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="checked" value="1">
                            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
                            <button type="submit">Yapıldı Olarak İşaretle</button>
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
            <th>Yapılanlar</th>
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
                    <td><?php echo $res['yapilacak']; ?></td>
                </tr>
            <?php endwhile; ?>
        </td>

    </tbody>
</table>