

<?php
require_once "functions.php";
   echo "<meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>";

if (!empty($_POST)) {
       if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
			
        } else {

        }
   $ok_page = mysql_query("select * from room_opros where id = $id");

	$data = mysql_real_escape_string(json_encode($_POST));
   if ($t_opros = mysql_fetch_array($ok_page))
{

	mysql_query("UPDATE room_opros set data='$data' where id = $id");

} else {
	mysql_query("INSERT INTO room_opros set data='$data', id = $id");
}
}
$back = $_SERVER['HTTP_REFERER'];
