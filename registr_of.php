<?php
/**
 * @author ������
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
 global $id_user, $site, $name_site, $god_site;
 if ($id_user == "")
 {
  error(6);
 }
 else
 {
  $regpodpos = regpodpos();
  $status = status();
  $dat = date("Y-m-d H:i");
  if ($regpodpos == "1" or $regpodpos == "2")
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
    die("����� ������ ���!");
   }
   $id = intval($id);
   if (isset($_GET['id_us']))
   {
    $id_us = addslashes($_GET['id_us']);
   }
   else
   {
    $id_us = $id_user;
   }
   if (!is_numeric($id_us))
   {
    die("����� ������ ���!");
   }
   $id_us = intval($id_us);
   if ($id == "0")
   {
    $name_user_off = user_info($id_us);
    echo "<h4 align = \"canter\">�� �������� ����������� $name_user_off �� $name_site $god_site</h4>";
    echo "��� ���� ����� ����������� ��������� ��������:";
    echo "<ul><li>������ �����������</li>";
    $sibkon = mysql_query("select * from sibkon where god = $god_site");
    while ($sib = mysql_fetch_array($sibkon))
    {
     $id_con = $sib['id'];
    }
    $mer_s = mysql_query("select * from meropriatia where id_con = $id_con");
    while ($mer_s_m = mysql_fetch_array($mer_s))
    {
     $id_mer = $mer_s_m['id'];
     $ok_page = mysql_query("select * from mer_us where id_command = $id_mer and id_us = $id_us");
     while ($t_page = mysql_fetch_array($ok_page))
     {
      $id_us_m = $t_page['id_us'];
      if (!($id_us_m == ""))
      {
       $merop = name_mer($id_mer);
       echo "<li>������ � $merop</li> ";
      }
     }
    }
    echo "</ul><div align=\"center\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"$site/registr_off.php?id=1\">����� ����������� �� $name_site</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>";
   }
   else
    if ($id == "1")
    {
     echo "<h4>����������� ��������� ��������:</h4><ul>";
     $sibkon = mysql_query("select * from sibkon where god = $god_site");
     while ($sib = mysql_fetch_array($sibkon))
     {
      $id_con = $sib['id'];
     }
     $mer_s = mysql_query("select * from meropriatia where id_con = $id_con");
     while ($mer_s_m = mysql_fetch_array($mer_s))
     {
      $id_mer = $mer_s_m['id'];
      $ok_page = mysql_query("select * from mer_us where id_command = $id_mer and id_us = $id_us");
      while ($t_page = mysql_fetch_array($ok_page))
      {
       $id_us_m = $t_page['id_us'];
       $tip_us = $t_page['tip'];
       $id_comm = $t_page['id_command'];
       $id_zap_mer = $t_page['id'];
       if (!($id_us_m == ""))
       {
        if ($tip_us == "1")
        {
         //�������� ��� ���� �������
         $ok_org_s = mysql_query("select * from org where god = $god_site");
         while ($org_s_i = mysql_fetch_array($ok_org_s))
         {
          $id_us_s = $org_s_i['id_org'];
          $id_us_s_name = user_info($id_us_s);
          $merop = name_mer($id_mer);
          $tip = "����� �� �������";
          $text = "������������ $name_user_off ��������� �� ������� � $merop ��������� ������������";
          ad_log($text);
          pager_post($id_us_s, $id_us, $text, $tip, $nit);
          echo "<li>��������� ������������ $id_us_s_name � ������ ��� � ��������� �������� ������������ $merop ����������</li>";
         }
         mysql_query("DELETE FROM mer_us WHERE   id = $id_zap_mer");
         echo "<li><b>����� ���� ������� � $merop</b></li>";
        }
        else
        {
         $merop = name_mer($id_mer);
         //�������� �����������, ���� ��� ������ ��������- ���������� �������������� ��������
         $mer_org = mysql_query("select * from mer_us where id_command = $id_mer and tip = 1");
         while ($mer_o = mysql_fetch_array($mer_org))
         {
          $id_us_org = $mer_o['id_us'];
          $id_us_org_name = user_info($id_us_org);
          $tip = "����� �� �������";
          $text = "������������ $name_user_off ��������� �� ������� � $merop";
          ad_log($text);
          pager_post($id_us_org, $id_us, $text, $tip, $nit);
          echo "<li>��������� ������������ $id_us_org_name � ������ ��� � $merop ����������</li>";
          mysql_query("DELETE FROM mer_us WHERE   id = $id_zap_mer");
         }
         mysql_query("DELETE FROM registr WHERE   god = '$god_site' and id_us = '$id_us'");
         echo "<li><b>����� ���� ������� � $merop</b></li>";
        }
       }
      }
     }
     $mess_log = "���� ����������� � $name_site $god_site";
     ad_log($mess_log);
     mysql_query("DELETE FROM registr WHERE   god = '$god_site' and id_us = '$id_us'");
     echo "</ul><h4 align = \"canter\">������ ����������� �� $name_site $god_site �����������.</h4>";
    }
  }
  else
  {
   error(17);
  }
 }
}
function title()
{
 global $name_site, $site, $god_site;
 echo "
<title>������ ����������� �� $name_site $god_site | $name_site</title>
";
}
function right()
{
}
require ("theme/$theme/$theme.htm");
?>