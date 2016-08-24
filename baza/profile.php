<?php 
require_once "functions.php";
include_once ('header.php');
 ?>
<div id="center_wrap">
	<div id="one_column">
	<center><b>Информация о участнике</b></center>
<?php
global $id_user, $site, $god_site;

        if (isset($_GET['id'])) {
            $id = addslashes($_GET['id']);
        } else {
            echo"none";
        }
        $query = "select * From `us` where `id_us` = '" . $id . "'";

		$result = mysql_query($query); {
            while ($link = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $act_us = "$link[act_us]";
                $id_u = "$link[id_us]";
                $name_us = "$link[name_us]";
                $fam_us = "$link[fam_us]";
                $tip_us = "$link[tip_us]";
                $nick_us = "$link[nick_us]";
                if ($tip_us == "9") {
                    $nick_us = "<strike>$nick_us</strike>";
                }
                $gorod_us = "$link[gorod_us]";
                $login_us = "$link[login_us]";
                $pass_us = "$link[pass_us]";
                $act_us = "$link[act_us]";
                $mail_us = "$link[mail_us]";
                $telefon_us = "$link[telefon_us]";
                $passport_us = "$link[passport_us]";
                $foto_us = "$link[foto_us]";
                $osebe = nl2br($link[osebe]);
                $god_us = "$link[god_us]";
                $contact = "$link[contact]";
                $contact = nl2br($link[contact]);
                $master = "$link[master]";
                $interest = "$link[interest]";
                $interest = nl2br($link[interest]);
            }
        }		
?>
	<div id=all_profile>
		<div id=info>
		<?php
		 $pict = "../user/photo/$id_u.jpg";
        if (file_exists($pict)) {
            list($width, $height, $type, $attr) = getimagesize($pict);
            if ($height > $width) {
                $vis1 = height;
            } else {
                $vis1 = width;
            }
            echo "<br><center>
<img src= \"$pict\" $vis1=\"200\"  border=\"0\" alt = \"$nick_us: $name_us $fam_us\"></center>";
        } else {
            echo "<br>
<center><img src= \"img/no.jpg\" border=\"0\" alt = \"$nick_us: $name_us $fam_us\"></center>";
        }
		
		echo "<br><center><b>$nick_us<br>
				$name_us $fam_us</b><br>
		Идентификатор: $id
		<br><a href=http://sibkon.org/profile.php?id=$id target=_blank>Профиль на сайте</a>
		</center>";
		?>
		</div>
		<div id=money>
		<b><center>Деньги:</center></b>
		<?php
			block_money();
		?>
		</div>
		<div id=status>
		<b><center>Статус поселения:</center></b>
		<?php
			 registr();
		?>
		</div>
		<div id=karma>
		<center><b>Карма: ТТТ</b>
		<br>
		<select>
		<option>Хорошо себя вел</option>
		<option>Помогал очень</option>
		</select>
		<br><br>
		<select>
		<option>Нассал в сугроб</option>
		<option>Разбил окно</option>
		</select>
		<button value="Не работает">Не работает</button>
		</center>
		</div>
		<div id=food>
		<?php opros2() ?>
		</div>
		<div id=food1>
		<center><b>Проставлять при заезде:</b>
		<?php 
		$query = mysql_query("SELECT * FROM `stat_baza` WHERE id_us = $id_u");
			while ($t_page = mysql_fetch_array($query)) {
			$proverka = $t_page['proverka'];
			$pitanie = $t_page['pitanie'];		
			$sanvznos = $t_page['sanvznos'];
			$summa_sanvznos = $t_page['summa_sanvznos'];
			$comment = $t_page['comment'];
			$room = $t_page['room'];
			}
		echo"<form action=\"admin/stat_base.php?id=$id_u\" method=\"post\">";
		echo"Приехал:<input type=checkbox name=proverka value=1 "; if ($proverka == 0) {echo"";} else {echo"checked=1";} echo">";
		echo"Оплатил проживание:<input type=checkbox name=room value=1 "; if ($room == 0) {echo"";} else {echo"checked=1";} echo">";
		echo"Оплатил еду:<input type=checkbox name=pitanie value=1 "; if ($pitanie == 0) {echo"";} else {echo"checked=1";} echo">";
		echo"Оплатил санвзнос:<input type=checkbox name=sanvznos value=1 "; if ($sanvznos == 0) {echo"";} else {echo"checked=1";} echo">
		Цена санвзноса:<input name=summa_sanvznos type=textarea value=$summa_sanvznos> <br>
		Комментарий:<textarea rows=1 cols=50 name=comment>$comment</textarea><br>
		<input type=submit name=ok value=\"Участник прибыл на базу\">
		</form>";
		?>
		</center>
		<?php
		?>
		</div>
		
		<!--<div id=podval>
		Доп. Функции:
		</div>-->
	</div>
		
	</div>
	<div id="two_column">
		<?php	include ('spisok.php');?>
	</div>
</div>
<?php
include_once ('footer.php');
?>