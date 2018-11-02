<?php

include 'sort.type.php'; #including type for

$row = false;

if(isset($_GET['id'])){

    $f = fetch(query("SELECT * FROM barang WHERE id = '$_GET[id]'"));

    $row = true;
    //echo $f['type'];

    $date = array(
        'tahun'     => date("Y", strtotime($f['date_expired'])),
        'bulan'     => date("m", strtotime($f['date_expired'])),
        'hari'      => date("d", strtotime($f['date_expired'])),
        'jam'       => '00:00:00'
    );
}

?>
<form name="barang" method="post" action="?p=process">
    <input name="id" type="hidden" value="<?php echo $_GET['id']; ?>">
    <table align="center" cellpadding="5px" border="1px">
        <tr>
            <th colspan="3" align="center"><?php if($row){ echo 'EDIT BARANG'; }else{ echo 'TAMBAH BARANG BARU'; } ?></th>
        </tr>
        <tr>
            <td>
                Nama Barang
            </td>
            <td>:</td>
            <td>
                <input name="name" type="text" placeholder="Masukan Nama Barang..." title="Nama" value="<?php if($row){ echo $f['name']; } ?>">
            </td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td>
                <input name="count" type="number" maxlength="4" minlength="1" value="<?php if($row){ echo $f['count']; } ?>" title="Jumlah">
            </td>
        </tr>
        <tr>
            <td>Type Barang</td>
            <td>:</td>
            <td>
                <select name="type" title="Barang">
                    <?php
                    if($row){ sorttype(null, $f['type']); }else{ sorttype(null); }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Expired
            </td>
            <td>:</td>
            <td>
                <input name="hari-exp" type="number" maxlength="2" max="31" min="1" value="<?php if($row){ echo $date['hari']; } ?>" title="Tanggal"><input name="bulan-exp" type="number" maxlength="2" max="12" min="1" value="<?php if($row){ echo $date['bulan']; } ?>" title="Bulan"><input name="tahun-exp" type="number" maxlength="4" min="2000" value="<?php if($row){ echo $date['tahun']; } ?>" title="Tahun">
            </td>
        </tr>
        <tr>
            <td>
                Pemilik
            </td>
            <td>:</td>
            <td>
                <input name="owner" type="text" placeholder="Masukan Nama Pemilik..." title="Nama Pemilik" value="<?php if($row){ echo $f['owner']; } ?>">
            </td>
        </tr>
        <tr>
            <td>
                Deskripsi
            </td>
            <td>:</td>
            <td>
                <textarea name="description" maxlength="500" placeholder="Masukan Deskripsi..." title="Deskripsi"><?php if($row){ echo $f['description']; } ?></textarea>
            </td>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <input name="submit" type="submit" value="SIMPAN"> | <input name="reset" type="reset" value="HAPUS SEMUA">
            </td>
        </tr>
    </table>

</form>