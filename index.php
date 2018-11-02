<?php

// Start The Session in front loaded website
session_start();

// Change the timezone this website to Jakarta
date_default_timezone_set("Asia/Jakarta");

// Including and requiring the config and function
include 'config.php';

// This is function for shortcut code
require 'includes/functions.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>


<!-- This is menu link for website -->
<center>
    <a href="?">HOME</a> | <a href="?p=login">LOGIN</a> | <a href="?p=tbarang">TAMBAH BARANG</a> | <a href="?p=lpinjam">LIST PEMINJAMAN</a> | <a href="?p=logout">LOGOUT</a>
<?php
echo '<br><br><span style="background: yellow; padding: 5px;">' . date("Y-m-d H:i:s", time()) . '</span>';
?>
</center>

<br>

<!-- Get Username if user is sign in before -->
<?php
getUser();
?>

<br>

<?php

/**
 * Swicth variable 'p' in _GET
 * 'p' is page
 * You can add your costum link in here
 * Im using PHP Page because for the hide code in viewer for browser
 */
if(isset($_GET['p'])){

    switch ($_GET['p']){

        case "tbarang";         // Get Page Goods Creating
        include "includes/barang.create.php";
        break;

        case "process";         // Process For Page Goods Creating
        include "includes/barang.process.php";
        break;

        case "uses";            // Process For uses Goods and change value in Database
        include "includes/barang.use.php";
        break;

        case "lpinjam";
        include "includes/pinjam.get.php";
        break;

        case "process_kembalikan";
        include "includes/pinjam.update.php";
        break;

        case "login";           // Log in or Sign in page
        include "includes/session/login.php";
        break;

        case "login-proses";    // Process for Log in page
        include "includes/session/session.php";
        break;

        case "logout";          // Logout loaded
        logout();
        break;

    }// END SWICTH

}
else
{
    /**
     * If not set variable 'p' or Not any page can be loaded
     * This code is loaded
     * 
     * ****************You can copy this code and creating the function**************
     * 
     * // SHOW BARANG IS DEFAULT PAGE IN HOME
     */
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

        // Query MySQL
        $query = query("SELECT * FROM barang");

        // Loop per rows in fetching array
        while ($q = fetch($query)) {

            if(isset($_GET['id']) && $_GET['id'] == $q['id']){
                echo '<tr style="background: #42f936;">';
            }else{
                echo '<tr>';
            }
            
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

            /**
             * [================='t'==================]
             * Get Variable 't' and 'i'
             * And its show form for using this Goods
             * 
             * ****************You can copy this code and creating the function**************
             */
            if(isset($_GET['t']) && isset($_GET['i']) && isset($_SESSION['user'])){

                // CHECKING 't' and 'i'
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
                }// END CODE CHEKING

            }else if(empty($_SESSION['user']) && !empty($_GET['t']) && $_GET['i'] == $q['id']){
                echo '<tr style="background: red;" align="center">
                <td colspan="7">---------------ANDA TIDAK DAPAT MEMINJAM BARANG INI, SILAHKAN LOGIN TERLEBIH DAHULU---------------</td>
                </tr>';
            }
            $cf++;

        }// END WHILE
        ?>

    </table>

    <?php

}       // END CODE OF SHOW BARANG 

?>

</body>
</html>