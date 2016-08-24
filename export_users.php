<Style>

table tr.top th {padding: 10px; border-left: 1px solid black;}
table tr.bottom th {padding: 10px; border-bottom: 1px solid black;}
table td:first {padding: 5px;text-align: left; }
table td {padding: 5px;text-align: left; vertical-align: top;}
table td.breakfast {border-left: 1px solid black;}
table tr.odd td {background: #DDDDDD; }
</style>
<?php
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";



   $ok_page = mysql_query("select * from room_opros");
echo "<h4 align = \"center\">Список регистрации на $name_site $god_site</h4>";
		$ok_reg = mysql_query("select * from registr  WHERE `reg` =  '1' and `god` = '$god_site'");
		$itog_reg1 = mysql_num_rows($ok_reg);
		echo "<p>Всего зарегистрированно: $itog_reg1</p>";
?>
<table cellspacing=0 cellpadding=0>

<tr class=bottom>
<th>Ник</th>
<th>Имя</th>
<th>Фамилия</th>
<th>Отчетство</th>
<th>Город</th>
<th>Емейл</th>
<th>Телефон</th>
<th>Паспорт</th>
<th>Статус</th>
<th>Команда</th>
<th>Орг</th>
<th>Участник</th>
<th>Регионал</th>
<th>Регионал - контакты</th>
<th>Поселение</th>
</tr>

<?php
		$registr = mysql_query("select * from registr where god = $god_site");
		while ($registr_s = mysql_fetch_array($registr))
		{
			$reg = $registr_s['reg'];
			$pod = $registr_s['pod'];
			$id_us = $registr_s['id_us'];
			$query = "select * From `us` where `id_us` = $id_us ";
			$result = mysql_query($query);
			while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
			{
				$tip_us = "$link[tip_us]";
				$nick_us = "$link[nick_us]";
				$gorod = "$link[gorod_us]";
				$name = "$link[name_us]";
                $fam = "$link[fam_us]";
				$otch = "$link[otch_us]";

                $mail_us = "$link[mail_us]";
                $telefon_us = "$link[telefon_us]";
                $passport_us = "$link[passport_us]";


                $pass = "$link[pass_us]";
			}
			$user = user_info($id_us);
			$status = statusp($id_us);



            $queryr = "select c.*, cu.tip as tip From `room_us` as cu, `room` as c where c.id_con = 2012 AND cu.`id_us` = $id_us and cu.id_command = c.id ";
            $resultr = mysql_query($queryr);
            $room = array();
            while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
            {

                if ($linkr['tip'] == 3) {
                    $room[] = $linkr['name'];
                }

            }
            $room = implode($room, '<br/> ');


            $queryr = "select c.*, cu.tip as tip, cu.gorod as gorod, cu.contact as contact From `regionals_us` as cu, `regionals` as c where c.id_con = 2012 AND cu.`id_us` = $id_us and cu.id_command = c.id ";
            $resultr = mysql_query($queryr);
            $reg = array();
            $reg_c = array();
            while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
            {

                if ($linkr['tip'] == 3) {
                    $reg[] = $linkr['gorod'];
                    $reg_c[] = $linkr['contact'];

                }

            }
            $reg = implode($reg, '<br/> ');
            $reg_c = implode($reg_c, '<br/> ');


            $queryr = "select c.*, cu.tip as tip From `mer_us` as cu, `meropriatia` as c where c.id_con = 22 AND cu.`id_us` = $id_us and cu.id_command = c.id ";
            $resultr = mysql_query($queryr);
            $org = array();
            $mer = array();
            while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
            {

                if ($linkr['tip'] == 1)
                    $org[] = $linkr['name'];

                if ($linkr['tip'] == 3)
                    $mer[] = $linkr['name'];

            }
            $org = implode($org, '<br/> ');
            $mer = implode($mer, '<br/> ');

            $queryr = "select c.* From `comand_us` as cu, `command` as c where cu.`id_us` = $id_us and cu.id_command = c.id ";
            $resultr = mysql_query($queryr);
            $team = array();
            while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
            {
                $team[] = $linkr['name'];
            }
            $team = implode($team, '<br/> ');

			if ($status == "1")
			{
				$status = "Зарегистрирован";
			}
			else
				if ($status == "2")
				{



                $queryr = "select * From `room_us` where `id_us` = $id_us ";
			$resultr = mysql_query($queryr);
			while ($linkr = mysql_fetch_array($resultr, MYSQL_ASSOC))
			{
			//	$id_room = "$linkr[id_command]";
			}
                if ($id_room == "")
                {
                    $status = "Подтвержден";
                }
                else
                {
                  $status =  name_room($id_room);
                }
                }

			echo "<tr>
<td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td>
<td>$name</td>
<td>$fam</td>
<td>$otch</td>
<td>$gorod</td>
<td>$mail_us</td>
<td>$telefon_us</td>
<td>$passport_us</td>
<td>$status $rom</td>
<td>$team</td>
<td>$org</td>
<td>$mer</td>
<td>$reg</td>
<td>$reg_c</td>
<td>$room</td>
</tr>";
            $id_room = "";
		}
		echo "</tbody></table><script type=\"text/javascript\">";
?>
</table>
