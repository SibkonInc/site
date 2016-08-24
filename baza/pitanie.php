<?php
require_once "functions.php";
include_once ('header.php');

   $ok_page = mysql_query("select * from `room_opros` where `data` LIKE '%\"2\",\"pitanie_choice\"%' or `data` LIKE '%\"3\",\"pitanie_choice\"%'");
   $i=0;
   $c=0;
   $e=0;
   $f=0;
?>
<div id="center_wrap">
	<div id="one_column">
<div id=sp_pit>
<table cellspacing=3 cellpadding=3 align=center border=1>
<tr class=top><th>Участник</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr>

<?php
$cnt = 0;

while ($t_opros = mysql_fetch_array($ok_page))
{
	$cnt++;
	  $opros = @json_decode($t_opros["data"]);
         $user = user_info($t_opros["id"]);
$class = ($cnt %2 == 0)?'even':'odd';
         echo "<tr class='$class'><td>$user</td>";
?>
		<td class='breakfast'><?php if($opros->pitanie == "3" or $opros->pitanie == "2" && in_array("1", $opros->pitanie_choice)) { ++$i?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "3"  or $opros->pitanie == "2" && in_array("2", $opros->pitanie_choice)) { ++$c;?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "3"  or $opros->pitanie == "2" && in_array("5", $opros->pitanie_choice)) { ++$e?>+<?php } ?></td>

		<td class='breakfast'><?php if($opros->pitanie == "3"  or $opros->pitanie == "2" && in_array("8", $opros->pitanie_choice)) { ++$f;?>+<?php } ?></td>
</tr>
<?php 
}
?>
</table>
</div>
<div id=stat_pit>
<b>Статистика по питанию:</b>
<br><br>
<?echo "Четверг - $i порций"?><br>
<?echo "Пятница - $c порций"?><br>
<?echo "Суббота - $e порций"?><br>
<?echo "Воскресение - $f порций"?>
<br><br>
<?php
$i=0;
$sql="select * from `room_opros` where `data` LIKE '%\"2\",\"pitanie_choice\"%' or `data` LIKE '%\"3\",\"pitanie_choice\"%'";

$res=mysql_query($sql);
while($row=mysql_fetch_assoc($res)){
        $i++;
}
echo 'Всего питаются <b>' .$i.'</b> чел.';
?>
	</div>
	</div>
	<div id="two_column">
		<?php	include ('spisok.php');?>
	</div>
</div>
<?php
include_once ('footer.php');
?>

