<?php
/**
 * @author yerick
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
    $id = 0;
  }
  if (!is_numeric($id))
  {
    die("Такой записи нет!");
  }
  $id = intval($id);
  $vopros = addslashes($_POST['vopros']);
  $komand = addslashes($_POST['komand']);
  $ok_page = mysql_query("select * from meropriatia where id = $id");
  while ($t_page = mysql_fetch_array($ok_page))
  {
    $comand = $t_page['komand'];
    $anketa = $t_page['anketa'];
  }
  if ($comand == "1" or $comand == "2")
  {
    $name_mer - name_mer($id);
    $mess_log = "Подал заявку на участие в $name_mer в команде \"$komand\"";
    ad_log($mess_log);
    mysql_query("insert into `mer_command`(id_mer,name,id_us) values('$id', '$komand', '$id_user')");
  }
  
  if ($anketa == "1")
  {
    mysql_query("insert into `mer_anketa`(id_mer,vopros,id_us) values('$id', '$vopros', '$id_user')");
  }
  $ok_page1 = mysql_query("select * from mer_us where id_command = $id and tip = 1");
  while ($t_page1 = mysql_fetch_array($ok_page1))
  {
    $id_us = $t_page1['id_us'];
  }
  mysql_query("insert into `query`(id_us,id_master,id_tip,id_mer) values('$id_user', '$id_us', '2', '$id')");
  $nit = mysql_insert_id();
  ad_log($mess_log);
  header("Location: $site/mer.php?id=$id");
}
?>