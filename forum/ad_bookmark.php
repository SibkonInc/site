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
 echo "Не могу";
}
else
{
 if (isset($_GET['id']))
 {
  $id = addslashes($_GET['id']);
 }
 $id = intval($id);
 mysql_query("insert into `podpiska`(id_us,id_forum) values('$id_user','$id')");

 echo iconv("CP1251", "utf-8", "Тема добавлена в вашу подписку");
}
?>