<?php

/* Database config */

$db_host		= 'mysql-1';
$db_user		= 'us3513b';
$db_pass		= 'ghtdtlrhfcfdxtu';
$db_database		= 'db3513b'; 

/* End config */


$link = @mysql_connect($db_host,$db_user,$db_pass) or die('Unable to establish a DB connection');

mysql_query("SET NAMES 'cp1251'");
mysql_select_db($db_database,$link);

?>