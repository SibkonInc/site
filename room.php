<?php /**
 * @author ������
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";

function posel()
{
   global $id_user, $site, $name_site, $god_site;
   echo "<h4 align = \"center\">������ �� ������� ����� ������� �������������.</h4>";
   echo "<table><tr><th>��������</th><th>���</th><th>���-��</th><th>������</th><th>��������</th><th>�������������</th><th>�������</th></tr>";
   $ok_page = mysql_query("select * from room where id_con = $god_site");
   while ($t_page = mysql_fetch_array($ok_page))
   {
      $id_room = $t_page['id'];
      $name_room = $t_page['name'];
      $glav = $t_page['glav'];
      $tip = $t_page['tip'];
      $kolvo = $t_page['kolvo'];
      $glav = user_info($glav);
      $ok_reg = mysql_query("select * From `room_us` where id_command = $id_room");
      $itog_reg1 = mysql_num_rows($ok_reg);
      $svobodno = $kolvo - $itog_reg1;
      if ($tip == 0)
      {
         $tip = "�� ����������";
      }
      else
         if ($tip == 1)
         {
            $tip = "�������";
            $color = "#AAD4FF";
         }
         else
            if ($tip == 2)
            {
               $tip = "���������";
               $color = "#7FFF7F";
            }
            else
               if ($tip == 3)
               {
                  $tip = "����";
                  $color = "#FFAAFF";
               }
			   else
               if ($tip == 4)
               {
                  $tip = "������� ���������";
                  $color = "#FFAAAA";
               }
			   			   else
               if ($tip == 5)
               {
                  $tip = "����������� ���������";
                  $color = "#FFAAAA";
               }
      echo "<tr bgcolor=\"$color\" ><td><a href = \"$site/room.php?id=$id_room\">$name_room</a></td><td>$tip</td><td>$kolvo</td><td>$itog_reg1</td><td>$svobodno</td><td>$glav</td><td>
    ";
      $gl_romm = "select * From `room_us` where `tip` = '1' and  id_command = $id_room";
      $gl_romm_res = mysql_query($gl_romm) or die("������ ���� ���");
      while ($gl_romm_res1 = mysql_fetch_array($gl_romm_res, MYSQL_ASSOC))
      {
         $id_us_glav = "$gl_romm_res1[id_us]";
      }
      if ($id_us_glav == "")
      {
         $ok_pagez = mysql_query("select * from query where id_tip = 4 and id_mer = $id_room and id_us = $id_user and ok = 0");
         while ($t_pagez = mysql_fetch_array($ok_pagez))
         {
            $id_usz = $t_pagez['id_us'];
            if ($id_usz == $id_user)
            {
               $messa = "1";
            }
         }
         if ($messa == "1")
         {
            echo "�� ��� ������ ������, �������� ������";
         }
         else
         {
            $poselen = poselen($id_user);
            if ($poselen == "")
            {
               echo "<a href = \"query/ad_room_ot.php?id=$id_room\">������ ������ �� ��������</a>";
            }
         }
         $messa = "";
      }
      else
      {
         $glav_ok = user_info($id_us_glav);
         echo "$glav_ok";
      }
      $id_us_glav = "";
      echo "</td></tr>
			";
   }
   echo "</table>";
   $ok_news1 = mysql_query("select sum(kolvo) from room where id_con=$god_site");
   while ($t_news1 = mysql_fetch_array($ok_news1))
   {
      $count1 = $t_news1['sum(kolvo)'];
      echo "����� ����: $count1";
   }
   echo "<br>�� ���:<br>";
   $name = ($_GET['name']);
   $tip = ($_GET['tip']);
   $kolvo = ($_GET['kolvo']);
   $otv = ($_GET['otv']);
   if ($otv == "")
   {
      $site_info = mysql_query("select * from setting_site");
      if (!mysql_num_rows($site_info))
         die("������ � ����� �� ��������.");
      else
      {
         while ($site_i = mysql_fetch_array($site_info))
         {
            $otv = $site_i['otv_pos'];
         }
      }
   }
   $ok_news1 = mysql_query("select tip,sum(kolvo) from room  where id_con=$god_site group by tip");
   while ($t_news1 = mysql_fetch_array($ok_news1))
   {
      $count1 = $t_news1['sum(kolvo)'];
      $count1tip = $t_news1['tip'];
      if ($count1tip == 0)
      {
         $count1tip_print = "�� ����������";
      }
      else
         if ($count1tip == 1)
         {
            $count1tip_print = "�������";
         }
         else
            if ($count1tip == 2)
            {
               $count1tip_print = "���������";
            }
            else
               if ($count1tip == 3)
               {
                  $count1tip_print = "����";
               }
			   else
               if ($count1tip == 4)
               {
                  $count1tip_print = "������� ���������";
               }
			   			   else
               if ($tip == 5)
               {
                  $tip = "����������� ���������";
                  $color = "#FFAAAA";
               }
      echo "$count1tip_print: $count1<br>";
   }
}
function room_info($id)
{
   global $id_user, $site, $name_site, $god_site;
   if (isset($_GET['ok']))
   {
      $ok = addslashes($_GET['ok']);
   }
   else
   {
      $ok = 0;
   }
   if (!is_numeric($ok))
   {
      die("����� ������ ���!");
   }
   $ok = intval($ok);
   if ($ok == "1")
   {
      echo "<h3 align =\"center\">���� ������ ����������, �������� ������</h3>";
   }
   $ok_page = mysql_query("select * from room where  id=$id");
   while ($t_page = mysql_fetch_array($ok_page))
   {
      $id_room = $t_page['id'];
      $name_room = $t_page['name'];
      $glav = $t_page['glav'];
      $tip = $t_page['tip'];
      $kolvo = $t_page['kolvo'];
      $glav = user_info($glav);
      $gl_romm = "select * From `room_us` where id_command = $id_room and tip = 1";
      $gl_romm_res = mysql_query($gl_romm) or die("������ ���� ���");
      while ($gl_romm_res1 = mysql_fetch_array($gl_romm_res, MYSQL_ASSOC))
      {
         $id_us_glav = "$gl_romm_res1[id_us]";
      }
      $us_glav = user_info($id_us_glav);
      if ($us_glav == "")
      {
         $us_glav = "<a href = \"������ ������\">������ ������</a>";
      }
      $ok_reg = mysql_query("select * From `room_us` where  id_command = $id_room");
      $itog_reg1 = mysql_num_rows($ok_reg);
      $svobodno = $kolvo - $itog_reg1;
      
      $room_kolvo = room_kolvo($id_room);
      if ($tip == 0)
      {
         $tip = "�� ����������";
      }
      else
         if ($tip == 1)
         {
            $tip = "�������";
            $color = "#AAD4FF";
         }
         else
            if ($tip == 2)
            {
               $tip = "���������";
               $color = "#7FFF7F";
            }
            else
               if ($tip == 3)
               {
                  $tip = "����";
                  $color = "#FFAAFF";
               }
			   else
               if ($tip == 4)
               {
                  $tip = "������� ���������";
                  $color = "#FFAAAA";
               }
			   else
               if ($tip == 5)
               {
                  $tip = "����������� ���������";
                  $color = "#FFAAAA";
               }
      echo "<h4 align = \"center\">$name_room</h4>
<table>
<tr><td>���:</td><td>$tip</td></tr>
<tr><td>�������������:</td><td>$glav</td></tr>
<tr><td>�������</td><td>";
      if ($id_us_glav == "")
      {
         $ok_pagez = mysql_query("select * from query where id_tip = 4 and id_mer = $id_room and id_us = $id_user and ok = 0");
         while ($t_pagez = mysql_fetch_array($ok_pagez))
         {
            $id_usz = $t_pagez['id_us'];
            if ($id_usz == $id_user)
            {
               $messa = "1";
            }
         }
         if ($messa == "1")
         {
            echo "�� ��� ������ ������, �������� ������";
         }
         else
         {
            $poselen = poselen($id_user);
            if ($poselen == "")
            {
               echo "<a href = \"query/ad_room_ot.php?id=$id_room\">������ ������ �� ��������</a>";
               $glav_yes = "0";
            }
         }
         $messa = "";
      }
      else
      {
         $glav_ok = user_info($id_us_glav);
         echo "$glav_ok";
      }
      echo "</td></tr>
<tr><td>���-�� ����</td><td>$kolvo</td></tr>
<tr><td>��������� ����</td><td>$room_kolvo</td></tr>
</table>
";
      if ($glav_yes == "0")
      {
         echo "������ ������ ����������, ��� ��������. �� ������ <a href = \"query/ad_room_ot.php?id=$id_room\">������ ������ �� ��������</a>";
      }
      else
      {
         if ($svobodno > 0)
         {
            $ok_pagez = mysql_query("select * from query where id_tip = 5 and id_mer = $id and id_us = $id_user and ok = 0");
            while ($t_pagez = mysql_fetch_array($ok_pagez))
            {
               $id_usz = $t_pagez['id_us'];
            }
            if ($id_usz == $id_user)
            {
               echo "�� ������ ��� ������ �� ����������, �������� �������.";
            }
            else
            {
               $poselen = poselen($id_user);
               if
               ($poselen == "")
                 
               { ?>	
<script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery('#example-1').click(function(){
                    jQuery(this).load('query/ad_room_pro.php?id=<? echo "$id"; ?>');                
                }) 
            });
            $("#loading").bind("ajaxSend", function(){
    $(this).show(); // ���������� �������
}).bind("ajaxComplete", function(){
    $(this).hide(); // �������� �������
});
    </script>        
       <div class="example cursor" id="example-1" align="center"><a>������ ������ �� ����������</a></div>
        <div  id="loading">����� ������ � ��������� �����...</div>
  <style type="text/css">#loading {display:none;}</style>	
		<?                }
            }

         }
         else
         {
            echo "��������� ����������, ���������� ����� ����";
         }
      }
      /////////////////////////////////////////////////////////////
      echo "<h5 align = center>���������</h5>";
      echo "<table>";
      $ok_page = mysql_query("select * from room_us where id_command = $id");
      {
         while ($t_page = mysql_fetch_array($ok_page))
         {
            $id_us_z = $t_page['id_us'];
            $tip_z = $t_page['tip'];
            $id_zap_us = $t_page['id'];
            $user_z = user_info($id_us_z);
            $query = "select * From `us` where `id_us` = $id_us_z";
            $result = mysql_query($query);
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
            {
               $tip_us = "$link[tip_us]";
               $nick_us = "$link[nick_us]";
               $gorod = "$link[gorod_us]";
               $name = "$link[name_us]";
               $fam = "$link[fam_us]";
            }
            if ($tip_z == "1")
            {
               $pict = "<img src=\"$site/img/ico/admin_icon.png\" border=\"0\" alt=\"����������\">";
            }
            else
               if ($tip_z == "2")
               {
                  $pict = "<img src=\"$site/img/ico/kwifimanager.png\" border=\"0\" alt=\"������������\">";
               }
               else
                  if ($tip_z == "3")
                  {
                     $pict = "<img src=\"$site/img/ico/kuser.png\" border=\"0\" alt=\"���������\">";
                  }
                  else
                  {
                     $pict = "";
                  }
                  echo "<tr><td>$pict</td><td>$user_z</td><td>$fam $name</td><td>$gorod</td>";
            $admq = dostup_adm();
            $orgq = dostup_org();
            $masterq = dostup_mer_adm($id);
            //� ������ �������� �������!
            if ($admq == "1" or $orgq == "1" or $masterq == "1" or $id_us_z == $id_user) //  ������������ or $id_us_z == $id_user), ����� ������� ����������� ��������� �� ������
            {
               echo "<td><a href=\"$site/room/del_user.php?id=$id_zap_us\" rel = \"facebox\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td>";
            }
            echo "</tr>";
         }
      }
      echo "</table>";
      echo "<h5 align = \"center\">����������</h5>";
      echo "<table>";
      $ok_prig = mysql_query("select * from query where id_tip = 5 and id_mer = $id  and ok = 5");
      while ($t_prig = mysql_fetch_array($ok_prig))
      {
         $id_prig = $t_prig['id_master'];
         $id_pr = $t_prig['id'];
         $user_prig = user_info($id_prig);
         $queryp = "select * From `us` where `id_us` = $id_prig";
         $resultp = mysql_query($queryp);
         while ($linkp = mysql_fetch_array($resultp, MYSQL_ASSOC))
         {
            $tip_usp = "$linkp[tip_us]";
            $nick_usp = "$linkp[nick_us]";
            $gorodp = "$linkp[gorod_us]";
            $namep = "$linkp[name_us]";
            $famp = "$linkp[fam_us]";
         }
         echo "<tr><td>$user_prig</td><td>$famp $namep</td><td>$gorodp</td>";
         
         $adm = dostup_adm();
         $org = dostup_org();
         $master = dostup_mer_adm($id);
    if ($adm == "1")
         {
           $poselen = poselen($id_prig);
           $name_room = name_room($poselen);
          $status = statusp( $id_prig);
         
         
           if (!($poselen==""))
           {
            echo"<td>$status $poselen $name_room</td>";
            }
            else
            {
                echo"<td><a href = query/ok.php?ok=1&id=$id_pr>��</a>$id_pr $status �����</td>";
            }
            
            
         }
         if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user)
         {
            echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td>";
         }
      }
      echo "</tr>";
      echo "</table>";
      echo "<h5 align = \"center\">������ ������</h5>";
      echo "<table>";
      $ok_prig = mysql_query("select * from query where id_tip = 5 and id_mer = $id  and ok = 0");
      while ($t_prig = mysql_fetch_array($ok_prig))
      {
         $id_prig = $t_prig['id_us'];
         $id_pr = $t_prig['id'];
         $user_prig = user_info($id_prig);
         $queryz = "select * From `us` where `id_us` = $id_prig";
         $resultz = mysql_query($queryz);
         while ($linkz = mysql_fetch_array($resultz, MYSQL_ASSOC))
         {
            $tip_usz = "$linkz[tip_us]";
            $nick_usz = "$linkz[nick_us]";
            $gorodz = "$linkz[gorod_us]";
            $namez = "$linkz[name_us]";
            $famz = "$linkz[fam_us]";
         }
         echo "<tr><td>$user_prig</td><td>$famz $namez</td><td>$gorodz</td>";
         $adm = dostup_adm();
         $org = dostup_org();
         $master = dostup_mer_adm($id);
           if ($adm == "1")
         {
           $poselen = poselen($id_prig);
           $name_room = name_room($poselen);
          $status = statusp( $id_prig);
         
         
           if (!($poselen==""))
           {
            echo"<td>$status $poselen $name_room</td>";
            }
            else
            {
                echo"<td><a href =query/ok.php?ok=1&id=$id_pr>��</a>$id_pr $status �����</td>";
            }
            
            
         }
         if ($adm == "1" or $org == "1" or $master == "1" or $id_prig == $id_user)
         {
            echo "<td><a href=\"$site/query/ok.php?ok=2&id=$id_pr\"><img src=\"$site/img/ico/file_delete.png\" border=\"0\" alt=\"�������\"></a></td>";
         }
      }
      echo "</tr>";
      echo "</table>";
      ///////////////////////////////////////////////////////
   }
}
function action()
{
   global $id_user, $site, $name_site, $god_site;
   if ($id_user == "")
   {
      error(6);
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
      $regpodpos = regpodpos();
      $status = statusp($id_us);
      if ($regpodpos == "3")
      {
         echo "<h3 align = \"center\">��������� �� $name_site $god_site</h3>";
         echo "<a href = \"$site/room.php\">����� ������</a> | ";
         $site_info = mysql_query("select * from setting_site");
         if (!mysql_num_rows($site_info))
            die("������ � ����� �� ��������.");
         else
         {
            while ($site_i = mysql_fetch_array($site_info))
            {
               $otv_pos = $site_i['otv_pos'];
               $shema = $site_i['shema'];
            }
         }
         if (!($shema == ""))
         {
            //echo "<a href =\"$site/page_sibkon.php?id=$shema\">����� ������������</a> | ";
           // echo "<a href =\"http://sibrpg.ru/upload/shemi.xls\">����� ������������</a> | ";

         }
         $otv_pos = user_info($otv_pos);
         if (!($otv_pos == ""))
         {
            echo "����������� �� ����� ���������: $otv_pos";
         }
         echo "
      <br>
      <br>������������� - �������, ������������ ����������. ����� �������� �� ��������� ���� ���������.
      <br>������� - ���������� �������, ���������� �� ������ ����� ���������.
      ";
         if ($status == "2")
         {
                
		 if ( $id == "")  {
//opros2() ;
                  posel();
		}
            
            else
            {
               room_info($id);
            }
         }
         else
         {
            error(19);
         }
      }
   }
}
function title()
{
   global $name_site, $site, $god_site;
   echo "
<title>��������� �� $name_site $god_site | $name_site</title>
";
}
function right()
{
}
require ("theme/$theme/$theme 2.htm"); ?>