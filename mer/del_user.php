<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	else
	{
		$id = 0;
	}
	if (!is_numeric($id))
	{
		die("Такой записи нет!");
	}
	$id = intval($id);
    
	$ok_page = mysql_query("select * from mer_us where id = $id");
	while ($t_page = mysql_fetch_array($ok_page))
	{
		$id_us = $t_page['id_us'];
        $mer = $t_page['id_command'];
		$user = user_inf($id_us);
		
	}
    
    $adm = dostup_adm();
$org = dostup_org();
$master = dostup_mer_adm($mer);
if ($adm == "1" or $org == "1" or $master = "1")
{
    
    echo iconv("CP1251", "utf-8", "
<a href= \"$site/mer/del_user_post.php?id=$id\">Вы хотите отказать в участии \"$user\" в мероприятии ?</a> ?");
    
    
    
}
else
{
	error(7);
}
?>