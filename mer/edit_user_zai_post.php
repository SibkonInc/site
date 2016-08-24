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
  header("Location: $site/error?id=7");
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
    die("“акой записи нет!");
  }
  $id = intval($id);
  if (isset($_GET['t']))
  {
    $t = addslashes($_GET['t']);
  }
  else
  {
    $t = 0;
  }
  if (!is_numeric($t))
  {
    die("“акой записи нет!");
  }
  $t = intval($t);
  $tip_us = addslashes($_POST['tip']);
  $vopros = addslashes($_POST['vopros']);
  $command = addslashes($_POST['komand']);
  if ($t == "2")
  {
    $zap1 = mysql_query("select * from query where id = $id");
    {
      while ($zp1 = mysql_fetch_array($zap1))
      {
        $ok = $zp1['ok'];
        if ($ok == "5")
          $id_us = $zp1['id_master'];
        else
        {
          $id_us = $zp1['id_us'];
        }
        $id_mer = $zp1['id_mer'];
        $tip_us = "0";
      }
    }
  }
  else
  {
    $zap = mysql_query("select * from mer_us where id = $id");
    {
      while ($zp = mysql_fetch_array($zap))
      {
        $id_us = $zp['id_us'];
        $id_mer = $zp['id_command'];
      }
    }
  }
  $zap = mysql_query("select * from meropriatia where id = $id_mer");
  {
    while ($zp = mysql_fetch_array($zap))
    {
      $anketa = $zp['anketa'];
      $komand = $zp['komand'];
    }
  }
  // echo "$t $id_mer $id_us $vopros $anketa $komand";
  $adm = dostup_adm();
  $org = dostup_org();
  $master = dostup_mer_adm($id_mer);
  if ($adm == "1" or $org == "1" or $master == "1" or $id_us == $id_user)
  {
    if (!($t == "2"))
    {
      mysql_query(" UPDATE mer_us SET tip = $tip_us where id = $id");
    }
    if ($komand == "1" or $komand == "2")
    {
      $zap3 = mysql_query("select * from mer_command where `id_mer` = $id_mer and `id_us` = $id_us");
      {
        while ($zp3 = mysql_fetch_array($zap3))
        {
          $name_kom = $zp3['name'];
        }
      }
      if (isset($name_kom))
      {
        mysql_query(" UPDATE  `mer_command` SET `name` = '$command' where `id_mer` = $id_mer and `id_us` = $id_us");
      }
      else
      {
        mysql_query("insert into `mer_command`(id_mer,name,id_us) values('$id_mer', '$command', '$id_us')");
      }
    }
    if ($anketa == "1")
    {
      $ok_prig = mysql_query("select * from mer_anketa where `id_mer` = $id_mer and `id_us` = $id_us");
      while ($t_prig = mysql_fetch_array($ok_prig))
      {
        $vopros1 = $t_prig['vopros'];
      }
      if (isset($vopros1))
      {
        mysql_query(" UPDATE  `mer_anketa` SET `vopros` = '$vopros' where `id_mer` = $id_mer and `id_us` = $id_us");
      }
      else
      {
        mysql_query("insert into `mer_anketa`(id_mer,vopros,id_us) values('$id_mer', '$vopros', '$id_us')");
      }
    }
    $user_name = user_info($id_us);
    $name_mer = name_mer($id_mer);
    $mess_log = "»зменил данные $user_name к $name_mer";
    ad_log($mess_log);
    header("Location: $site/mer.php?id=$id_mer&tip=6");
  }
  else
  {
    header("Location: $site/error?id=7");
  }
}
//вы€сн€ем тип участника
//вы€сн€ем название команды
//вы€сн€ем анкету
//вы€сн€ем общий статус - одобрено отклонено

?>