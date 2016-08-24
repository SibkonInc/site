<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<?php

ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";



   $ok_page = mysql_query("select * from room_opros");
   $i=0;
   $c=0;
   $e=0;
   $f=0;
   

?>
<table cellspacing=3 cellpadding=3  align=center border=1><tr><td>
<center>Список питающихся на фестивале:</center><br>
<table cellspacing=3 cellpadding=3 align=center>
<tr class=top><th>&nbsp;</th><th>Чт</th><th>Пт</th><th>Сб</th><th>Вс</th></tr>

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
function title()
{
	global $id_us, $name_site;
	$g = addslashes($_GET['g']);
	echo "
<title>$g Пользователи сайта | $name_site</title>
<script type=\"text/javascript\" src=\"$site/js/jquery.dataTables.js\"></script>
<link type=\"text/css\" rel=\"stylesheet\" href=\"$site/js/dataTables.css\" media=\"all\">
";
}

?>

</table>
</td><td valign=top>
Статистика по питанию в дни проведения фестиваля:<br><br>
<table cellspacing=3 cellpadding=3 align=center border=1>
<tr><td><?echo "Четверг - $i"?>
<td><?echo "Пятница - $c"?></td></tr>
<tr><td><?echo "Суббота - $e"?>
<td><?echo "Воскресение - $f"?></td></tr>
</table>
</td></tr></table>
