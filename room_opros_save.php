<?php
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";


if (!empty($_POST)) {

   $ok_page = mysql_query("select * from room_opros where id = $id_user");

	$data = mysql_real_escape_string(json_encode($_POST));
   if ($t_opros = mysql_fetch_array($ok_page))
{
	mysql_query("UPDATE room_opros set data='$data' where id = $id_user");

} else {
	mysql_query("INSERT INTO room_opros set data='$data', id = $id_user");
}
}

header("Location: /profile.php");