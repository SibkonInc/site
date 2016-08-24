<?php 
require_once "functions.php";
include_once ('header.php');
 ?>
<div id="center_wrap">
	<div id="one_column">
	<center>
<?php
   global $id_user, $site, $name_site, $god_site;
   echo "<table><tr><th>Название</th><th>Тип</th><th>Кол-Во</th><th>Занято</th><th>Свободно</th><th>Главный</th></tr>";
   $ok_page = mysql_query("select * from room where id_con = $god_site");
   while ($t_page = mysql_fetch_array($ok_page))
   {
      $id_room = $t_page['id'];
      $name_room = $t_page['name'];
      $glav = $t_page['glav'];
      $tip = $t_page['tip'];
      $kolvo = $t_page['kolvo'];
      $ok_reg = mysql_query("select * From `room_us` where id_command = $id_room");
      $itog_reg1 = mysql_num_rows($ok_reg);
      $svobodno = $kolvo - $itog_reg1;
      if ($tip == 0)
      {
         $tip = "Не определено";
      }
      else
         if ($tip == 1)
         {
            $tip = "Кровати";
            $color = "#AAD4FF";
         }
         else
            if ($tip == 2)
            {
               $tip = "Спальники";
               $color = "#7FFF7F";
            }
            else
               if ($tip == 3)
               {
                  $tip = "Люкс";
                  $color = "#FFAAFF";
               }
			   else
               if ($tip == 4)
               {
                  $tip = "Дневное поселение";
                  $color = "#FFAAAA";
               }
      echo "<tr bgcolor=\"$color\" ><td>$name_room</td><td>$tip</td><td>$kolvo</td><td>$itog_reg1</td><td>$svobodno</td><td>";
      $gl_romm = "select * From `room_us` where `tip` = '1' and  id_command = $id_room";
      $gl_romm_res = mysql_query($gl_romm) or die("Данных пока нет");
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
            echo "Вы уже подали заявку, ожидайте ответа";
         }
         else
         {
            $poselen = poselen($id_user);
            if ($poselen == "")
            {
               echo "<b>ПУСТО!</b>";
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
      echo "всего мест: $count1";
   }
   echo "<br>Из них:<br>";
   $name = ($_GET['name']);
   $tip = ($_GET['tip']);
   $kolvo = ($_GET['kolvo']);
   $otv = ($_GET['otv']);
   if ($otv == "")
   {
      $site_info = mysql_query("select * from setting_site");
      if (!mysql_num_rows($site_info))
         die("Данные о сайте не получены.");
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
         $count1tip_print = "Не определено";
      }
      else
         if ($count1tip == 1)
         {
            $count1tip_print = "Кровати";
         }
         else
            if ($count1tip == 2)
            {
               $count1tip_print = "Спальники";
            }
            else
               if ($count1tip == 3)
               {
                  $count1tip_print = "Люкс";
               }
			   else
               if ($count1tip == 4)
               {
                  $count1tip_print = "Дневное поселение";
               }
      echo "$count1tip_print: $count1<br>";
   }

?>
</center>
	</div>
	<div id="two_column">
		<?php	include ('spisok.php');?>
	</div>
</div>