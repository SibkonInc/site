<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	global $id_user, $god_site;
	if (!($id_user == ""))
	{
		$id_us = ($_POST['id_us']);
		$ok_page = mysql_query("SELECT * FROM `module` WHERE `file` = 'regionals'");
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id_modul = $t_page['id'];
			$name_modul = $t_page['name'];
			$file = $t_page['file'];
			$on = $t_page['on'];
		}
		$ok_page1 = mysql_query("SELECT * 
FROM `regionals` 
WHERE `id_con` =$god_site");
		while ($t_page1 = mysql_fetch_array($ok_page1))
		{
			$id = $t_page1['id'];
			$id_con = $t_page1['id_con'];
			$text = $t_page1['text'];
			$id_org = $t_page1['id_org'];
		}
		$tip = "3";
		if ($tip == 1) $name = name_module('regionals');
		$name = "Службу $name";
		$queryq = mysql_query("select * from regionals_us  WHERE id_us = $id_us and id_command = $id");
		while ($query_iq = mysql_fetch_array($queryq))
		{
			$idq = $query_iq['id'];
		}
		$user = user_info($id_user);
		$user_kogo = user_info($id_us);
		if ($idq == "")
		{
			$date_news = date("Y-m-d H:i");
			mysql_query("insert into `query`(id_us,id_master,id_tip,id_mer,ok) values('$id_user', '$id_us', '$tip', '$id', '5')");
			$nit = mysql_insert_id();
			mysql_query("insert into `query_module`(id_query,id_module) values('$nit', 'regionals')");
			$mess_log = "$user пригласил $user_kogo в $name. Ид заявка $nit";
			ad_log($mess_log);
			echo "Ваше приглашение в $name пользователю $user_kogo успешно выслано.";
		}
		else
		{
			echo "Ваше приглашение в $name пользователю $user_kogo не может быть выслано. Пользователь уже в этой группе.";
		}
	}
	else
	{
		error(7);
	}
}
function title()
{
	global $id_user, $name_site;
	echo "
<title>Добавление новости | $name_site</title>";
}
function right()
{
}
require ("../theme/$theme/$theme.htm");
?>