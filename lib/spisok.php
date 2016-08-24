<?
require_once "../lib/seting.php";
require_once "../lib/funcms.php";
//Выводим страницу
//общий список юзеров
function action()
{
	global $id_user, $site;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
		echo "<div align=\"center\"><h3>Пользователи сайта.</h3></div>";
		echo "
<table id=\"example\" class=\"display\">
<thead>
<tr><th>Ник</th><th>Имя</th><th>Фамилия</th><th>Город</th></tr>
</thead>
<tbody>
";
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
		}
		$result = mysql_query($query) or die("Query failed : " . mysql_error());
		while ($link = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$id_us = "$link[id_us]";
			$name_us = "$link[name_us]";
			$fam_us = "$link[fam_us]";
			$nick_us = "$link[nick_us]";
			$gorod_us = "$link[gorod_us]";
			echo "
<tr><td><a title = \"$nick_us\" href = \"$site/profile.php?id=$id_us\">$nick_us</a></td><td>$name_us</td><td>$fam_us</td><td>$gorod_us</td></tr>";
		}
		echo "
</tbody>
<tfoot>
<tr><th>Ник</th><th>Имя</th><th>Фамилия</th><th>Город</th></tr>
</tfoot>
</table>
<script type=\"text/javascript\">
$(document).ready(function(){
  $(\"#example\").dataTable();
});
</script>";
	}
}
//просмотр юзера одного
function right()
{
	$ok_news1 = mysql_query("select count(id_us) from us");
	while ($t_news1 = mysql_fetch_array($ok_news1))
	{
		$count = $t_news1['count(id_us)'];
	}
	$ok_news2 = mysql_query("select count(gorod_us) from us group by gorod_us");
	while ($t_news2 = mysql_fetch_array($ok_news2))
	{
		$countgorod_us = $t_news2['count(gorod_us)'];
	}
	echo "<table><tr><td><b><a href = \"$site/users.php\">Пользователей</a></b>:</td><td>$count</td></tr>";
	$ok_news1 = mysql_query("select gorod_us,count(id_us) from us group by gorod_us");
	while ($t_news1 = mysql_fetch_array($ok_news1))
	{
		$count1 = $t_news1['count(id_us)'];
		$gorod_us = $t_news1['gorod_us'];
		echo "<tr><td><a href = \"$site/users.php?g=$gorod_us\">$gorod_us</a></td><td>$count1</td></tr>";
	}
	echo "</table>";
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