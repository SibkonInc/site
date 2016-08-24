<? 

   global $id_user, $site, $name_site, $god_site;
   $ok_page = mysql_query("select * from room_opros");	
   
   $array = array (1, "1", 1, "2", 1,"5");
print_r(array_count_values ($array));

?>
<table cellspacing=0 cellpadding=0 align=center>
<tr class=top><th style="background:#dadada;">зђ</th><th style="background:#decbc8;">Яђ</th><th style="background:#e4e8c9;">бс</th><th style="background:#dadada;">Тё</th></tr>
<?php
while ($t_opros = mysql_fetch_array($ok_page))
{
		$opros = @json_decode($t_opros["data"]);
        echo "<tr>";
?>
		<td align=center style="background:#dadada;"><?php if($opros->pitanie == "2" && in_array("1", $opros->pitanie_choice)) { ?>123<?php } ?></td>

		<td align=center style="background:#decbc8;"><?php if($opros->pitanie == "2" && in_array("2", $opros->pitanie_choice)) { ?>+<?php } ?></td>

		<td align=center style="background:#e4e8c9;"><?php if($opros->pitanie == "2" && in_array("5", $opros->pitanie_choice)) { ?>+<?php } ?></td>

		<td align=center style="background:#dadada;"><?php if($opros->pitanie == "2" && in_array("8", $opros->pitanie_choice)) { ?>+<?php } ?></td>
</tr>
<?php 
}
echo "</table>";
