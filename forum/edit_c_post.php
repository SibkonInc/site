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
 $id = "00";
}
if (!is_numeric($id))
{
 die("Такой записи нет!");
}
$id = intval($id);
//вкл\откл админ доступа к редактированию сообщений
//$adm = dostup_adm();
//if ($adm == "1")
//{
 $text = addslashes($_POST['text']);
 mysql_query(" UPDATE comment SET   text='$text' where id_com = '$id'");
 $ok_com = mysql_query("select * from `comment` where `id_com` = $id");
 while ($row = mysql_fetch_array($ok_com))
 {
  $id_page = $row['id_page'];
 }

 $ok_page = mysql_query("select * from forum where id = $id_page");
 while ($t_page = mysql_fetch_array($ok_page))
 {
  $id_f = $t_page['id'];
  $name = $t_page['name'];
 }

 $mess_log = "Изменил коммент $id <a href = $site/forum.php?id=$id_page>$name</a>";
 ad_log($mess_log);
 header("Location: $site/forum.php?id=$id_page");
//вкл\откл админ доступа к редактированию сообщений
 //}
//else
//{
// header("Location: $site/error.php?i=7");
//}
?>