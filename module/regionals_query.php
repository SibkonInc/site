<?php
/**
 * @author нукшсл
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
if ($id_user == "")
{
	echo "Не могу записать вас. Вы не авторизованны";
}
else
{
	if (isset($_GET['id']))
	{
		$id = addslashes($_GET['id']);
	}
	$id = intval($id);
	$ok_page = mysql_query("select * from regionals where id = $id");
	{
		while ($t_page = mysql_fetch_array($ok_page))
		{
			$id_com = $t_page['id'];
			$id_us = $t_page['id_org'];
			$name = $t_page['name'];
		}
		mysql_query("insert into `query`(id_us,id_master,id_tip,id_mer) values('$id_user', '$id_us', '3', '$id')");
		$nit = mysql_insert_id();
		mysql_query("insert into `query_module`(id_query,id_module) values('$nit', 'regionals')");
		$user = user_info($id_user);
		$name = name_comand($id);
		$mess_log = "$user подал заявку вступить в Службу Регионалов. Ид заявки $nit";
		ad_log($mess_log);
		echo "Заявка отправлена, ожидайте ответа";
	}
}
?>