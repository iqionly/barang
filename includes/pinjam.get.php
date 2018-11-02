<?php

echo '<table border="1px" cellpadding="5px" align="center">

    <tr style="background: #f3f3f3;">

        <th>No.</th>

        <th>Nama Barang</th>

        <th>Jumlah Barang</th>

        <th>Tanggal Dipinjam</th>

        <th>Pengguna</th>

        <th>Tanggal Kembali</th>

        <th>Status</th>

        <th>Aksi</th>

    </tr>';

    $cf = 1;

    $alert = 0;

    // Query MySQL
    $query = query("SELECT barang.id AS idb, barang.name, barang.type, uses.id AS id_pinjam, uses.id_barang, uses.id_user, uses.date_use, uses.date_back, uses.count, uses.status FROM barang, uses WHERE barang.id = uses.id_barang AND uses.status = 'PENDING' GROUP BY uses.id");

    // Loop per rows in fetching array
    while ($q = fetch($query)) {

        echo '<tr>';
        echo '<td>' . $cf . '</td>';
        echo '<td>' . $q['name'] . '</td>';
        echo '<td>' . $q['count'] . '</td>';
        echo '<td>' . datep($q['date_use']) . '</td>';
        echo '<td>' . $q['type'] . '</td>';
        echo '<td>' . $q['date_back'] . '</td>';
        echo '<td>'; echo 'Belum Dikembalikan'; echo '</td>';

        echo '<td>';
        if(isset($_SESSION['user'])){
        echo
        '
        <a href="?p=lpinjam&t=kembali&i=' . $q['id_barang'] . '">KEMBALIKAN</a>';
        }else{
        	echo ' | <a href="?id=' . $q['id_barang'] . '">LIHAT BARANG</a>';
        }
        echo '</td>
        </tr>';

        /**
         * [================='t'==================]
         * Get Variable 't' and 'i'
         * And its show form for using this Goods
         * 
         * ****************You can copy this code and creating the function**************
         */
        if(isset($_GET['t']) && isset($_GET['i']) && isset($_SESSION['user'])){

            // CHECKING 't' and 'i'
            if($_GET['t'] == 'kembali' && $_GET['i'] == $q['id_pinjam'] && $_SESSION['user'] == $q['id_user']){
                echo '
                <form method="post" action="?p=process_kembalikan">
                <input name="id" type="hidden" value="' . $q['idb'] . '">
                <tr>
                    <td colspan="6"> Anda dapat mengembalikan barang jika anda login terlebih dahulu </td>
                    <td> <input name="submit" type="submit" value="KEMBALIKAN" title="Kembalikan" > | <input type="reset" value="RESET"> </td>
                    <td> <a href="?p=lbarang">CANCEL</a> </td>
                </tr>
                </form>';
            }
            else
            {
            	echo "<center>MAAF AKUN ANDA TIDAK DIPERBOLEHKAN MENGEMBALIKAN BARANG INI</center><br>";
            }

        }
        else
        {	
        	if($alert == 0)
        		echo '<center><span style="background: red; padding: 5px;">ANDA BELUM LOGIN UNTUK MENGAKSES KEMBALI BARANG</span></center><br><br>';
        		$alert = 1;
        }
        $cf++;

    }// END WHILE
    
echo '</table>';