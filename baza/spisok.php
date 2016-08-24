<script type="text/javascript">
$(document).ready(function(){
  $("#example").dataTable();
});
</script>

				<?php
		if (isset($_GET['g']))
		{
			$g = addslashes($_GET['g']);
		}
		else
		{
			$g = "";
		}
		if (!($g == ""))
		{
			$query = "select * From `us` where act_us = '1' and gorod_us = '$g'";
		}
		else
		{
			$query = "select * From `us` where act_us = '1'";
		}?>
		<center>
<b>Поиск среди участников</b>
<div id=spisok1>
<table id="example" class="display" style="max-width:340px;">
<thead>
<tr><th></th><th></th><th></th></tr>
</thead>
<tbody>
<?php
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$id_us = "$link[id_us]";
			$name_us = "$link[name_us]";
			$fam_us = "$link[fam_us]";
			$nick_us = "$link[nick_us]";
			$all = $fam_us.' '. $name_us.' '.$nick_us;
			echo "<tr><td><a title = \"$nick_us\" href = \"profile.php?id=$id_us\">$nick_us</a></td><td>$name_us</td><td>$fam_us</td></tr>";
		}
?>
</tbody>
<tfoot>
<tr><th></th><th></th><th></th></tr>
</tfoot>
</table>
		</div>