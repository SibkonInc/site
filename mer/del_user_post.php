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
  header("Location: $site/error.php?i=7");
}
else
{
  if (isset($_GET['id']))
  {
    $id = addslashes($_GET['id']);
  }
  else
  {
    $id = 1;
  }
  if (!is_numeric($id))
  {
    die("Такой записи нет!");
  }
  $id = intval($id);
  $ok_page = mysql_query("select * from mer_us where id = $id");
  while ($t_page = mysql_fetch_array($ok_page))
  {
    $id = $t_page['id'];
    $id_command = $t_page['id_command'];
    $id_us = $t_page['id_us'];
    $user = user_info($id_us);
    $name_comand = name_mer($id_command);
  }
  $adm = dostup_adm();
  $org = dostup_org();
  $master = dostup_mer_adm($id_command);
  if ($adm == "1" or $org == "1" or $master = "1")
  {
    $mess_log = "Удалил $user из мероприятия $name_comand";
    ad_log($mess_log);
    mysql_query("DELETE FROM mer_us WHERE   id = '$id'");
    header("Location: $site/mer.php?id=$id_command");
  }
  else
  {
    header("Location: $site/error.php?i=7");
  }
}
?>