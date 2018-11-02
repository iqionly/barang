<?php

function connect()
{

	$account = unserialize(ACCOUNT);

	$connect = mysqli_connect(
		$account['host'],
		$account['user'],
		$account['pass'],
		$account['data']
	) or die (
		mysqli_error($connect)
	);

	mysqli_select_db(
		$connect,
		$account['data']
	);

	if( $connect && DEBUG )
	{
		//echo "SUCCESS<br>";
	}

	return $connect;

}

function query($query){
	$q = mysqli_query(connect(), $query) or die(mysqli_error(connect()));
    return $q;
}// END FUNCTION query

function fetch($result)
{
	return mysqli_fetch_array($result);
}// END FUNCTION fetch

function numr($result)
{
	return mysqli_num_rows($result);
}// END FUNCTION numr

function rd($str)
{
    return str_replace("\\", "/", $str);
}// END FUNCTION replacedelimeter

/**
 * 
 * Function Redirect
 * Default home url
 * 
 */
function redirect($to=null)
{
	if($to == null){
		echo '<script>window.location.href = "' . HTTP . rd(BASE_PATH) . '"</script>';
	}
	else
	{
		echo '<script>window.location.href = "' . HTTP . rd(BASE_PATH) . '?' . $to . '"</script>';
	}
}// END FUNCTION redirect ( javascript redirect code )

function checkSession($session_id)
{
	$r = query("SELECT * FROM user WHERE id = '$session_id'");
	$n = numr($r);

	if($n == 1)
	{
		return true;
	}
	else
	{
		return false;
	}

}// END FUNCTION checksession is valid or not

function datenow()
{
	return date("Y-m-d H:i:s", time());
}// END FUNCTION datenow

function getUser()
{
	if(isset($_SESSION['user']))
	{
		$f = fetch(query("SELECT * FROM user WHERE id = '$_SESSION[user]'"));

		echo '
		<table align="center" border="1" cellpadding="5px">
			<tr style="background: #f3f3f3;">
				<th> USER </th>
			</tr>
			<tr  style="background: red;">
				<td> ' . $f['name'] . '</td>
			</tr>
		</table>
		';
	}
}// END FUNCTION getUser

function logout()
{
	unset($_SESSION['user']);
	session_destroy();

	redirect();
}// END FUNCTION Logout

function datep($date)
{

	$d = strtotime($date);

	$v = date("l, j M Y", $d ) . " Pukul " . date("H:i:s", $d);

	return $v;

}

