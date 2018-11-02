<?php

/**
 * Core System Peminjaman Barang
 * Author IZZY25
 * With SublimeText 3
 * Created 28/10/2018
 */

if( isset($_POST) && isset($_SESSION['user'])){

	//echo "BERHASIL";

	$STATUS = true;

	if(checkSession($_SESSION['user']) == false){

		$STATUS = false;

	}

	if($STATUS == true)
	{

		//echo "BERHASIL";
		$f = fetch(query("SELECT id FROM user WHERE id = '$_SESSION[user]'"));

		$d = array(
		'date_now'	=>datenow(),
		'count'		=>$_POST['jumlah'],
		'id_user'	=>$f[0],
		'id_barang'	=>$_POST['id'],
		'description'=>$_POST['description']
		);

		//echo "BERHASIL";

		$n = 1 + numr(query("SELECT * FROM uses"));

		query("INSERT INTO uses VALUES('$n', '$d[id_barang]', '$d[id_user]', 'PENDING', '$d[date_now]', '0000-00-00 00:00:00', '$d[count]', '$d[description]')");

		$r = fetch(query("SELECT id, count FROM barang WHERE id = '$d[id_barang]'"));

		$jumlah = $r['count'] - $d['count'];

		query("UPDATE barang SET count = '$jumlah' WHERE id = '$d[id_barang]'");

		redirect();

	}
	else
	{
		redirect();
	}

}else
{
	redirect();
}

?>