<?php
/**
 * @author ������
 * @copyright 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	global $site, $status_site, $name_group, $god_site, $id_user, $name_site;
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
	$adm = dostup_adm();
	$org_god = dostup_org_god($god_site);
	$upravlenie = dostup_mer_adm($id);
	if ($id_user == "")
	{
		error(7);
	}
	else
	{
		if ($upravlenie == "1")
		{
			$ok_page = mysql_query("select * from meropriatia where id = $id");
			{
				while ($t_page = mysql_fetch_array($ok_page))
				{
					$id = $t_page['id'];
					$name = $t_page['name'];
					$text = nl2br($t_page['text']);
					$id_con = $t_page['id_con'];
					$tip = $t_page['tip'];
					$tip = name_tip($tip);
					$podtip = $t_page['podtip'];
					$podtip = name_podtip($podtip);
					$name_mer = name_mer($id);
				}
			}
			$ok_sibkon = mysql_query("SELECT * FROM `sibkon` WHERE `id` = $id_con");
			while ($t_sibkon = mysql_fetch_array($ok_sibkon))
			{
				$id_sibkon = $t_sibkon['id_con'];
				$god = $t_sibkon['god'];
				$tema = $t_sibkon['tema'];
			}
			echo "
<p>
	<a href = \"$site/sibkon.php?id=$god\">$name_site $god: $tema</a> | $tip | $podtip | $name_mer
	";
			echo "<h3 align = \"center\">���������� ������� � $name</h3>";


			$date_news = date("Y-m-d");
		echo "
<form name=\"form1\" method=\"post\" action=\"ad_news_post.php?id=$id\">
<table>
<tr><td>��������:</td><td><input type=\"text\"  name='name' size=\"86\"></td></tr>
<tr><td>����:</td><td><input type=\"text\"  name='date' size=\"86\" value= \"$date_news\"></td></tr>
</table>
<p>�����<br><textarea name='text' rows=\"36\" cols='96' ></textarea></p>
<div align=\"right\">
<ul class='nNav' style=\"width:135px;padding:0px;margin:0px;\">
<li style=\"margin:0px 3px 0px 0px;\">
<b class=\"nc\"><b class=\"nc1\"><b></b></b><b class=\"nc2\"><b></b></b></b>
<span class=\"ncc\"><a href=\"javascript:document.form1.submit()\">�������� �������</a></span> 
<b class=\"nc\"><b class=\"nc2\"><b></b></b><b class=\"nc1\"><b></b></b></b>
</li>
</ul>
</div>
<p> <input name = \"kno\" type=\"submit\" value='.' style=\"color:#fff;border:0;padding:0;margin:0;background:#fff;height:6px;width:6px\"/>                           
</form>
";
		}
		else
		{
			error(7);
		}
	}
}
function title()
{
	global $name_site, $name_group;
	echo "

";
	echo "
    <script src=\"$site/js/addElements.js\" type='text/javascript'></script>
<title>���������� ������� $name_group | $name_site</title>";
}
function right()
{
	
}
require ("../theme/$theme/$theme.htm");
?>