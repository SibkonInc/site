<?php /**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function uprav($id)
{ ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#a<? echo "$id"; ?>").click(
    function () {
      $.ajax({
        type: "GET",
        url: "query/ok.php?ok=1&id=<? echo "$id"; ?>"
      });
    });
    $("#b<? echo "$id"; ?>").click(
    function () {
      $.ajax({
        type: "GET",
        url: "query/ok.php?ok=2&id=<? echo "$id"; ?>"
      });
    });
     
});
$(document).ready(function(){
	$(".pane .delete").click(function(){
		$(this).parents(".pane").animate({ backgroundColor: "#fbc7c7" }, "fast")
		.animate({ opacity: "hide" }, "slow")
		return false;
	});
});
</script>
<? }
function action()
{
   global $site, $id_user, $god_site;
   if (isset($_GET['id_user']))
   {
      $i_user = addslashes($_GET['id_user']);
   }
   else
   {
      $i_user = 0;
   }
   if (!is_numeric($i_user))
   {
      die("����� ������ ���!");
   }
   //�������� ����������
   if ($i_user == "0")
   {
      echo "<h2 align='center'>���������� ������� � �����������</h2><h4 align = \"center\">��������</h4>";
      //�������� ������� ���
      $query = mysql_query("select * from query  WHERE id_master = $id_user and `ok` = '0'");
      while ($query_i = mysql_fetch_array($query))
      {
         $id = $query_i['id'];
         $id_us = $query_i['id_us'];
         $id_master = $query_i['id_master'];
         $id_tip = $query_i['id_tip'];
         $id_mer = $query_i['id_mer'];
         $ok = $query_i['ok'];
         $text = $query_i['text'];
         $user = user_info($id_us);
         if ($id_tip == "1")
         {
            $tip = "����� ������ �� ������� � �������";
            $name_comand = name_comand($id_mer);
         }
         if ($id_tip == "4")
         {
            $tip = "����� ������ �� �������� � ";
            $name_comand = name_room($id_mer);
         }
         if ($id_tip == "5")
         {
            $tip = "����� ������ �� ���������� � ";
            $name_comand = name_room($id_mer);
         }
         if ($id_tip == "3")
         {
            $tip = "����� ������ �� ������� � ";
            $query = mysql_query("select * from query_module  WHERE id_query = $id");
            while ($query_i = mysql_fetch_array($query))
            {
               $id_module = $query_i['id_module'];
            }
            $name_comand = name_module($id_module);
         }
         if ($id_tip == "2")
         {
            $ok_mer = mysql_query("select * from meropriatia where id = $id_mer");
            while ($t_mer_m = mysql_fetch_array($ok_mer))
            {
               $komand = $t_mer_m['komand'];
               $anketa = $t_mer_m['anketa'];
            }
            if ($komand == "1" or $komand == "2")
            {
               $ok_kom = mysql_query("select * from mer_command where id_us = $id_us and id_mer = $id_mer");
               while ($t_kom_m = mysql_fetch_array($ok_kom))
               {
                  $name_komand = $t_kom_m['name'];
                  if ($name_komand == "")
                  {
                     $name_komand = "� ��������� �������";
                  }
                  else
                  {
                     $name_komand = "� ������� \"$name_komand\"";
                  }
               }
            }
            if ($anketa == "1")
            {
               $ok_kom = mysql_query("select * from mer_anketa where id_us = $id_us and id_mer = $id_mer");
               while ($t_kom_m = mysql_fetch_array($ok_kom))
               {
                  $vopros = nl2br($t_kom_m['vopros']);
                  $vopros = "<br>������ ������:<br> $vopros";
               }
            }
            $tip = "����� ������ $name_komand �� ������� � ";
            $name_comand = name_mer($id_mer);
         }
         echo "
<div class=\"pane\">
<div class=\"pane_p\">
<div class=\"text_block\">
<br>$user $tip $name_comand $text $vopros</div><br>
<b class=\"ncp\"><b class=\"ncp1\"><b></b></b><b class=\"ncp2\"><b></b></b></b>
<span class=\"nccp\">
<a  href=\"#\" class=\"delete\" id=\"a$id\" title = \"��������\">��������</a> | <a  href=\"#\" class=\"delete\" id=\"b$id\" title = \"��������\">��������</a>
</span>
<b class=\"ncp\"><b class=\"ncp2\"><b></b></b><b class=\"ncp1\"><b></b></b></b>
</div></div>";
         uprav($id);
      }
      // ��������� ����������� ���
      $query = mysql_query("select * from query  WHERE id_master = $id_user and `ok` = '5'");
      while ($query_i = mysql_fetch_array($query))
      {
         $id = $query_i['id'];
         $id_us = $query_i['id_us'];
         $id_master = $query_i['id_master'];
         $id_tip = $query_i['id_tip'];
         $id_mer = $query_i['id_mer'];
         $ok = $query_i['ok'];
         $text = $query_i['text'];
         $user = user_info($id_us);
         if ($id_tip == "1")
         {
            $tip = "��������� � �������";
            $name_comand = name_comand($id_mer);
         }
         if ($id_tip == "3")
         {
            $tip = "��������� � ";
            $query = mysql_query("select * from query_module  WHERE id_query = $id");
            while ($query_i = mysql_fetch_array($query))
            {
               $id_module = $query_i['id_module'];
            }
            $name_comand = name_module($id_module);
         }
         if ($id_tip == "2")
         {
            $tip = "��������� ������� ������� �";
            $name_comand = name_mer($id_mer);
         }
         if ($id_tip == "4")
         {
            $tip = "��������� ������� �";
            $name_comand = name_room($id_mer);
         }
         if ($id_tip == "5")
         {
            $tip = "��������� �";
            $name_comand = name_room($id_mer);
         }
         echo "
<div class=\"pane\">
<div class=\"pane_p\">
<div class=\"text_block\">
<br>$user $tip $name_comand $text</div><br>
<b class=\"ncp\"><b class=\"ncp1\"><b></b></b><b class=\"ncp2\"><b></b></b></b>
<span class=\"nccp\">
<a  href=\"#\" class=\"delete\" id=\"a$id\" title = \"��������\">��������</a> | <a  href=\"#\" class=\"delete\" id=\"b$id\" title = \"��������\">��������</a>
</span>
<b class=\"ncp\"><b class=\"ncp2\"><b></b></b><b class=\"ncp1\"><b></b></b></b>
</div></div>";
         uprav($id);
      }
      //��������� ���������
      echo "<h4 align = \"center\">���������</h4>";
      $query = mysql_query("select * from query  WHERE id_us = $id_user and `ok` = '0'");
      while ($query_i = mysql_fetch_array($query))
      {
         $id = $query_i['id'];
         $id_us = $query_i['id_us'];
         $id_master = $query_i['id_master'];
         $id_tip = $query_i['id_tip'];
         $id_mer = $query_i['id_mer'];
         $ok = $query_i['ok'];
         $text = $query_i['text'];
         $user = user_info($id_us);
         if ($id_tip == "1")
         {
            $tip = "�� ������ ������ � �������";
            $name_comand = name_comand($id_mer);
         }
         if ($id_tip == "3")
         {
            $tip = "�� ������ ������ � ";
            $query = mysql_query("select * from query_module  WHERE id_query = $id");
            while ($query_i = mysql_fetch_array($query))
            {
               $id_module = $query_i['id_module'];
            }
            $name_comand = name_module($id_module);
         }
         if ($id_tip == "2")
         {
            $tip = "�� ������ ������ �� ������� �";
            $name_comand = name_mer($id_mer);
         }
         if ($id_tip == "4")
         {
            $tip = "�� ������ ������ �� �������� �";
            $name_comand = name_room($id_mer);
         }
         if ($id_tip == "5")
         {
            $tip = "�� ������ ������ �� ���������� �";
            $name_comand = name_room($id_mer);
         }
         echo "
<div class=\"pane\">
<div class=\"pane_p\">
<div class=\"text_block\">
<br>$tip $name_comand $text</div><br>
<b class=\"ncp\"><b class=\"ncp1\"><b></b></b><b class=\"ncp2\"><b></b></b></b>
<span class=\"nccp\">
<a  href=\"#\" class=\"delete\" id=\"b$id\" title = \"��������\">����������</a>
</span>
<b class=\"ncp\"><b class=\"ncp2\"><b></b></b><b class=\"ncp1\"><b></b></b></b>
</div></div>";
         uprav($id);
      }
      $query = mysql_query("select * from query  WHERE id_us = $id_user and `ok` = '5'");
      while ($query_i = mysql_fetch_array($query))
      {
         $id = $query_i['id'];
         $id_us = $query_i['id_us'];
         $id_master = $query_i['id_master'];
         $id_tip = $query_i['id_tip'];
         $id_mer = $query_i['id_mer'];
         $ok = $query_i['ok'];
         $text = $query_i['text'];
         $user = user_info($id_master);
         if ($id_tip == "1")
         {
            $tip = "�� ���������� $user � �������";
            $name_comand = name_comand($id_mer);
         }
         else
            if ($id_tip == "3")
            {
               $tip = "�� ���������� $user � ";
               $query1 = mysql_query("select * from query_module  WHERE id_query = $id");
               while ($query_i1 = mysql_fetch_array($query1))
               {
                  $id_module = $query_i1['id_module'];
               }
               $name_comand = name_module($id_module);
            }
         if ($id_tip == "2")
         {
            $tip = "�� ���������� $user ������� ������� �";
            $name_comand = name_mer($id_mer);
         }
         if ($id_tip == "5")
         {
            $tip = "�� ���������� $user �";
            $name_comand = name_room($id_mer);
         }
         if ($id_tip == "4")
         {
            $tip = "�� ���������� $user �� �������� �";
            $name_comand = name_room($id_mer);
         }
         echo "
<div class=\"pane\">
<div class=\"pane_p\">
<div class=\"text_block\">
<br>$tip $name_comand $text</div><br>
<b class=\"ncp\"><b class=\"ncp1\"><b></b></b><b class=\"ncp2\"><b></b></b></b>
<span class=\"nccp\">
<a  href=\"#\" class=\"delete\" id=\"b$id\" title = \"��������\">��������</a>
</span>
<b class=\"ncp\"><b class=\"ncp2\"><b></b></b><b class=\"ncp1\"><b></b></b></b>
</div></div>";
         uprav($id);
      }
   }
   else
   {
      //�������� ����������� �������������
      $user_pr = user_inf($i_user);
      echo "<h3 align = \"center\">���������� ������������ $user_pr</h3>";
      $status = statusp($i_user);
      if ($status < "2")
      {
         echo "�� �� ������� ���������� ������������ �� �����������, ��� ��� �� �� �����������.";
      }
    $ok_reg = mysql_query("select * from comand_us  WHERE `id_us` =  '$id_user'");
	  $itog_reg1 = mysql_num_rows($ok_reg);
      $ok_regm = mysql_query("select * from mer_us  WHERE `id_us` =  '$id_user'");
      $itog_reg1m = mysql_num_rows($ok_regm);
      $ok_regr = mysql_query("select * from room_us  WHERE `id_us` =  '$id_user'");
      $itog_reg1r = mysql_num_rows($ok_regr);
      if ($itog_reg1 > "0" or $itog_reg1m > "0" or $itog_reg1r > "0")
      {
         //��������� ����� �� ���� �������. ��� ������ �� ��������
         echo "<form name=\"form1\" method=\"post\" action=\"$site/query/ad_post_prig.php?id_us=$i_user\">
			<select id=\"first\" name=\"tip\" size=\"1\">
			<option value=\"\">--</option>
			</select>
			<select id=\"second\" name=\"id\" size=\"1\">
			<option value=\"\">--</option>
			</select>
			<br><br>
			���������� ����� ������ �� �� �����������, ������� ���� �������� �� ������� ��������� � ��� ���� �������� ��������������. <br>
			�����������, �� ��������� ���������, � ������ ����������� �� ������������.<br><br>
			<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>

<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">������� �����������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\">                           
</form>
"; ?>
<script type="text/JavaScript">
 $(document).ready(function()
 {
	    var selectoptions = {
	       <? $ok_reg = mysql_query("select * from comand_us  WHERE `id_us` =  '$id_user'");
         $itog_reg1 = mysql_num_rows($ok_reg);
         if ($itog_reg1 > "0")
         {
            echo "\"�������\": {
    	         \"key\" : 1,
                 \"defaultvalue\" : 11,
    	         \"values\" : {
    	         	";
            $ok_reg1 = mysql_query("select * from comand_us  WHERE `id_us` =  '$id_user'");
            while ($t_page1 = mysql_fetch_array($ok_reg1))
            {
               $id_com = $t_page1['id_command'];
               $ok_reg2 = mysql_query("select * from command  WHERE `id` =  '$id_com'");
               while ($t_page2 = mysql_fetch_array($ok_reg2))
               {
                  $id_comand = $t_page2['id'];
                  $name_comand = $t_page2['name'];
                  echo "
            \"$name_comand\": $id_comand,";
               }
            } ?>                    	
      }
},
              <? }
         if ($status == "2")
         {
            $ok_reg = mysql_query("select * from mer_us  WHERE `id_us` =  '$id_user'");
            $itog_reg1 = mysql_num_rows($ok_reg);
            if ($itog_reg1 > "0")
            {
               echo "\"�����������\": {
    	         \"key\" : 2,
                 \"defaultvalue\" : 11,
    	         \"values\" : {
    	         	";
               $ok_reg1 = mysql_query("select * from mer_us  WHERE `id_us` =  '$id_user'");
               while ($t_page1 = mysql_fetch_array($ok_reg1))
               {
                  $id_com = $t_page1['id_command'];
				  $id_con = 
                  $ok_reg2 = mysql_query("select * from meropriatia  WHERE `id` =  '$id_com' and `yes`!=1 and `id_con` = 28");
                  while ($t_page2 = mysql_fetch_array($ok_reg2))
                  {
                     $id_comand = $t_page2['id'];
                     $name_comand = $t_page2['name'];
                     $name_comand = htmlspecialchars($name_comand);
                     echo "
            \"$name_comand\": $id_comand,";
                  }
               }
               echo "
  }
 },";
            }
            $poselen = poselen($i_user);
            if ($poselen == "")
            {
				
               $ok_regr = mysql_query("select * from room_us  WHERE `id_us` =  '$id_user'");
               $itog_regr = mysql_num_rows($ok_regr);
               if ($itog_regr > "0")
               {
                  echo "\"�������\": {
    	         \"key\" : 5,
                 \"defaultvalue\" : 11,
    	         \"values\" : {
    	         	";
                  $ok_reg4 = mysql_query("select * from room_us  WHERE `id_us` =  '$id_user' and `god` = $god_site");
                  while ($t_page4 = mysql_fetch_array($ok_reg4))
                  {
                     $id_room = $t_page4['id_command'];
                     $room_kolvo = room_kolvo($id_room);
                     $name_room = name_room_name($id_room);
                     if ($room_kolvo > "0")
                     {
                        echo "
            \"$name_room (�������� $room_kolvo)\": $id_room,";
                     }
                  }
               }
               echo "
  }
 },";
            }
            $ok_regrg = mysql_query("select * from room  WHERE `glav` =  '$id_user' and id_con = $god_site");
            $itog_regrg = mysql_num_rows($ok_regrg);
            if ($itog_regrg > "0")
            {
               echo "\"������� �\": {
    	         \"key\" : 4,
                 \"defaultvalue\" : 11,
    	         \"values\" : {
    	         	";
               $ok_reg45 = mysql_query("select * from room  WHERE `glav` =  '$id_user' and id_con = $god_site");
               while ($t_page45 = mysql_fetch_array($ok_reg45))
               {
                  $id_room1 = $t_page45['id'];
                  $name_room1 = name_room_name($id_room1);
                  $ok_reg4 = mysql_query("select * from room_us  WHERE `id_command` =  '$id_room1' and tip = 1");
                  while ($t_page4 = mysql_fetch_array($ok_reg4))
                  {
                     $tip1 = $t_page4['tip'];
                     $id_room_gl = $t_page4['id_command'];
                    
                  }
                    if ($id_room_gl == "")
                     {
                        echo "
            \"$name_room1 $id_room_gl\": $id_room1,";
                     }
                $id_room_gl = "";  
                  
               }
              
               echo "
  }
 },";
            }
         } ?> 
};
$('#first').doubleSelect('second', selectoptions);      
 });
</script>			
		<? }
      else
      {
         error(14);
      }
   }
}
function title()
{
   global $name_site, $site;
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
   if ($id == 0)
   {
      echo "
		<script type=\"text/javascript\" src=\"$site/js/jquery.doubleSelect.min.js\"></script>
		<title>������� | $name_site</title>";
   }
}
function right()
{
   global $id_user, $site;
   if (!($id_user == ""))
   {
   }
}
require ("theme/$theme/$theme.htm"); ?>