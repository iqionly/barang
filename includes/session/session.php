<?php

if(isset($_POST['username']))
{
	$u = $_POST['username'];
	$q = query("SELECT * FROM user WHERE name = '$u'");

	//var_dump($q);

	$f = fetch($q);
	$n = numr($q);

	//echo $n;

	if($n == 1)
	{

		$_SESSION['user'] = $f['id'];

		redirect();
	}
	else
	{
		redirect('p=login&a=false');
	}

}
else
{
	redirect();
}

