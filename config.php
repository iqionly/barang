<?php

// DEBUG ::boolean
$DEBUG		= true;

// BASE_PATH is your current root folder
$BASE_PATH	= "localhost\barang";

// SLL/TLS or NOT
$SSL        = "http://";

$HOST		= "localhost";
$DATA		= "db_barang";
$USER		= "root";
$PASS		= "";

// DEFINE TO CONST VARIABLE in ACCOUNT
define("ACCOUNT", serialize(array(
		"host"		=> $HOST,
		"data"		=> $DATA,
		"user"		=> $USER,
		"pass"		=> $PASS
)));

// DEFINE DEBUG
define("DEBUG", $DEBUG);

// DEFINE BASE_PATH
define("BASE_PATH", $BASE_PATH);

// DEFINE HTTP
define("HTTP", $SSL);