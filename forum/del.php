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
if (isset($_GET['i']))
{
 $i = addslashes($_GET['i']);
}
else
{
 $i = "00";
}
$i = intval($i);
$adm = dostup_adm();
if ($adm == "1")
{
 if ($i == "1")
 {
  $ok_page = mysql_query("select * from forum where id = $id");
  while ($t_page = mysql_fetch_array($ok_page))
  {
   $id = $t_page['id'];
   $name = $t_page['name'];
   $t = $t_page['org'];
   $pr_zap = $t_page['pr_zap'];
   $com_count = $t_page['com_count'];
   $id_us = $t_page['id_us'];
   $avtor = user_info($id_us);
   $text = nl2br($t_page['text']);
  }
  $mess_log = "Удалил форум  $name c текстом <br>$text<br>Автор: $avtor<br>Отношение $t - $pr_zap";
  ad_log($mess_log);
  mysql_query("DELETE FROM forum WHERE   id = '$id'");
  mysql_query("DELETE FROM comment WHERE   id_page = '$id'");
  header("Location: $site/forum.php");
 }
 else
  if ($i == "2")
  {
   $ok_com = mysql_query("select * from comment where id_com = $id ");
   while ($row = mysql_fetch_array($ok_com))
   {
    $id_com = $row['id_com'];
    $id_us_com = $row['id_us'];
    $id_page = $row['id_page'];
    $text_com = nl2br($row['text']);
    $avtor_com = user_info($id_us_com);
    $com_otv = $row['com_otv'];
   }
   $mess_log = "Удалил коментарий  $id_com c текстом <br>$text_com<br>Автор: $avtor_com<br>Отношение $id_page";
   ad_log($mess_log);
   mysql_query("DELETE FROM comment WHERE   id_com = $id");
   $ok_news = mysql_query("select com_count from forum where id = $id_page");
   while ($t_news = mysql_fetch_array($ok_news))
   {
    $com_count = $t_news['com_count'];
   }
   $com_count1 = $com_count - 1;
   mysql_query(" UPDATE forum SET com_count=$com_count1 where id = $id_page");
   header("Location: $site/forum.php?id=$id_page");
  }
  else
  {
   header("Location: $site/error.php?i=1");
  }
}
else
{
 header("Location: $site/error.php?i=7");
}
?>