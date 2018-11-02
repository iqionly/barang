<center>
<br>
<?php
if(isset($_GET['a'])){
?>
<span style="background: red; color: white; padding: 5px;">ANDA SALAH MEMASUKAN USERNAME!!!</span>
<?php
}
?>
<br>
<br>
<br>
	<form name="login" method="post" action="?p=login-proses">
	USERNAME : <input name="username" type="text" placeholder="Masukan username anda..." title="Username"><br>
	<br>
	<input name="submit" type="submit" value="LOGIN" title="Sign In"> | <a href="?">CANCEL</a>
	</form>
</center>