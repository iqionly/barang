<?php

session_start();

date_default_timezone_set("Asia/Jakarta");

include 'config.php';
require 'includes/functions.php';

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>

<center>
    <a href="?">HOME</a> | <a href="?p=login">LOGIN</a> | <a href="?p=tbarang">TAMBAH BARANG</a> | <a href="#">LIST PEMINJAMAN</a> | <a href="?p=logout">LOGOUT</a>
<?php
echo '<br><br><span style="background: yellow; padding: 5px;">' . date("Y-m-d H:i:s", time()) . '</span>';
?>
</center>
<br>
<?php
getUser();
?>
<br>
<?php
if(isset($_GET['p'])){
    switch ($_GET['p']){
        case "tbarang";
        include "includes/barang.create.php";
        break;
        case "process";
        include "includes/barang.process.php";
        break;
        case "uses";
        include "includes/barang.use.php";
        break;
        case "login";
        include "includes/session/login.php";
        break;
        case "login-proses";
        include "includes/session/session.php";
        break;
        case "logout";
        logout();
        break;
    }
}else{
    ?>
    <table border="1px" cellpadding="5px" align="center">
        <tr style="background: #f3f3f3;">
            <th>No.</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Tanggal Disimpan</th>
            <th>Terakhir Dipinjam</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php

        $cf = 1;

        $query = query("SELECT * FROM barang");

        while ($q = fetch($query)) {
            //var_dump($q);
            echo '<tr>';
            echo '<td>' . $cf . '</td>';
            echo '<td>' . $q['name'] . '</td>';
            echo '<td>' . $q['count'] . '</td>';
            echo '<td>' . datep($q['date_created']) . '</td>';
            echo '<td>' . $q['date_modified'] . '</td>';
            echo '<td>'; if($q['visible']){ echo "ADA"; }else{ echo "PENDING"; } echo '</td>';
            echo
            '<td>
            <a href="?t=pinjam&i=' . $q['id'] . '">PINJAM</a> | <a href="?p=tbarang&id=' . $q['id'] . '">EDIT</a>
        </td>';
            echo '</tr>';
            if(isset($_GET['t']) && isset($_GET['i'])){
                if($_GET['t'] == 'pinjam' && $_GET['i'] == $q['id']){
                    echo '
                    <form method="post" action="?p=uses">
                    <input name="id" type="hidden" value="' . $q['id'] . '">
                    <tr>
                        <td colspan="5"> Jumlah : <input name="jumlah" type="number" title="Jumlah Dipinjam" value="0" min="1" max="' . $q['count'] . '"> <br> <textarea name="description" type="text" placeholder="Masukan Catatan Anda..." title="Deskripsi" maxlength="500"></textarea> </td>
                        <td> <input name="submit" type="submit" value="PINJAM" title="Pinjam" > | <input type="reset" value="RESET"> </td>
                        <td> <a href="?">CANCEL</a> </td>
                    </tr>
                    </form>';
                }
            }
            $cf++;
        }
        ?>

    </table>
    <?php
}
?>

</body>
</html>