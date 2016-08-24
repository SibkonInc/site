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
$adm = dostup_adm();
$org_god = dostup_org_god($god_site);
$org_mer = dostup_mer_adm($id);
if ($adm == "1" or $org_god == "1" or $org_mer == "1")
{
  $id_con = addslashes($_POST['id_con']);
  $name = addslashes($_POST['name']);
  $text = addslashes($_POST['text']);
  $tip = addslashes($_POST['tip']);
  $podtip = addslashes($_POST['podtip']);
  $yes = addslashes($_POST['yes']);
  $forum = addslashes($_POST['forum']);
  $forum_all = addslashes($_POST['forum_all']);
  $files = addslashes($_POST['files']);
  $mat = addslashes($_POST['mat']);
  $uprav = addslashes($_POST['uprav']);
  $news = addslashes($_POST['news']);
  $zakrito = addslashes($_POST['zakrito']);
  $anketa = addslashes($_POST['anketa']);
  $komand = addslashes($_POST['komand']);
  $us = addslashes($_POST['us']);
  $tender = addslashes($_POST['tender']);
  $org = addslashes($_POST['org']);
  $v_spiske = addslashes($_POST['v_spiske']);
  $ok_page_u = mysql_query("select * from mer_us where tip = 1 and id_command = $id");
  while ($t_page_u = mysql_fetch_array($ok_page_u))
  {
    $id_us_u = $t_page_u['id_us'];
  }
  if ($id_us_u == "")
  {
    mysql_query("insert into `mer_us`(tip,id_us,id_command) values('1', '$org',  '$id')");
  }
  if ($yes == "0")
  {
    if ($org_god == "1")
    {
      mysql_query(" UPDATE meropriatia SET id_con ='$id_con', name ='$name', text='$text', tip ='$tip', podtip ='$podtip', yes='$yes',tender='$tender', us='$us', v_spiske='$v_spiske' where id = '$id'");
      mysql_query(" UPDATE mer_us SET id_us = $org where id_command = $id and tip = 1");
      $ok_page = mysql_query("select * from sibkon where id = $id_con");
    }
    if ($org_mer == "1")
    {
      mysql_query(" UPDATE meropriatia SET id_con ='$id_con', name ='$name',  text='$text',  forum='$forum', forum_all='$forum_all', files='$files', mat='$mat', uprav='$uprav', tender='$tender', news='$news', zakrito='$zakrito', anketa='$anketa', komand='$komand' , us='$us', v_spiske='$v_spiske' where id = '$id'");
      $ok_page = mysql_query("select * from sibkon where id = $id_con");
    }
    if ($adm = "1")
    {
      mysql_query(" UPDATE meropriatia SET id_con ='$id_con', name ='$name',  text='$text',  forum='$forum', forum_all='$forum_all', files='$files', mat='$mat', uprav='$uprav', tender='$tender', news='$news', zakrito='$zakrito', anketa='$anketa', komand='$komand' , tip ='$tip', podtip ='$podtip', yes='$yes',tender='$tender', us='$us', v_spiske='$v_spiske' where id = '$id'");
      mysql_query(" UPDATE mer_us SET id_us = $org where id_command = $id and tip = 1");
      $ok_page = mysql_query("select * from sibkon where id = $id_con");
    }
  }
  else
  {
    if ($org_god == "1" or $adm == "1")
    {
      mysql_query(" UPDATE meropriatia SET id_con ='$id_con', name ='$name',  text='$text',  forum='$forum', forum_all='$forum_all', files='$files', mat='$mat', uprav='$uprav', tender='$tender', news='$news', zakrito='$zakrito', anketa='$anketa', komand='$komand' , tip ='$tip', podtip ='$podtip', yes='$yes',tender='$tender', us='$us', v_spiske='$v_spiske' where id = '$id'");
      mysql_query(" UPDATE mer_us SET id_us = $org where id_command = $id and tip = 1");
      $ok_page = mysql_query("select * from sibkon where id = $id_con");
    }
    if ($org_mer == "1")
    {
      mysql_query(" UPDATE meropriatia SET id_con ='$id_con', name ='$name',  text='$text',  forum='$forum', forum_all='$forum_all', files='$files', mat='$mat', uprav='$uprav', tender='$tender', news='$news', zakrito='$zakrito', anketa='$anketa', komand='$komand' , us='$us', v_spiske='$v_spiske' where id = '$id'");
      $ok_page = mysql_query("select * from sibkon where id = $id_con");
    }
  }
  while ($t_page = mysql_fetch_array($ok_page))
  {
    $id_con = $t_page['id'];
    $god = $t_page['god'];
    $tema = $t_page['tema'];
  }
  $mess_log = "Изменил группу <a href = $site/mer.php?id=$id>$name</a> к проекту <a href = $site/sibkon.php?id=$god>$god: $tema</a>";
  ad_log($mess_log);
  header("Location: $site/mer.php?id=$id");
}
else
{
  header("Location: $site/error.php?i=7");
}
?>