<?php

$DEBUG		= true;

$BASE_PATH	= "localhost\barang";
$SSL        = "http://";

$HOST		= "localhost";
$DATA		= "db_barang";
$USER		= "root";
$PASS		= "";


define("ACCOUNT", serialize(array(
		"host"		=> $HOST,
		"data"		=> $DATA,
		"user"		=> $USER,
		"pass"		=> $PASS
)));

define("DEBUG", $DEBUG);

define("BASE_PATH", $BASE_PATH);

define("HTTP", $SSL);