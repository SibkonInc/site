<?php
/**
 * @author Yerick
 * @copyright 2009
 * @name YCMS 2009
 */
ini_set("include_path", getenv("DOCUMENT_ROOT") . "/lib");
require_once "seting.php";
require_once "funcms.php";
function action()
{
	global $id_user, $site;
	if ($id_user == "")
	{
		error(6);
	}
	else
	{
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
		if (isset($_GET['ok']))
		{
			$ok = addslashes($_GET['ok']);
		}
		else
		{
			$ok = 0;
		}
		$ok = intval($ok);
		echo "<h3>�������� ���������</h3>";
		echo "������������ ";
		user_information($id);
		if ($ok == "1")
		{
			echo " c�������� ����������.";
		}
		else
		{
			echo "<br>
<form name=\"form1\" method=\"post\" action = \"$site/pager/pager_post.php?id_us=$id&amp;ok=1\">
����:<input type=\"text\" name='tip' size=\"86\">
�����<br><textarea name='text' id=\"html\" rows=\"20\" cols='96' ></textarea><p>
<div align=\"right\">
<input name = \"kno\" type=\"submit\" value='��������� ���������'> 
</div>
               
</form>";
?>
<script type="text/javascript">
$(function () { 
	$('form').submit(function () {
		$('input[type="submit"]', this).replaceWith('<p><strong>����� ������ � ��������� �����...</strong></p>');
	});
});
</script>   
<?
		}
	}
}
function title()
{
	global $id_us, $name_site, $site;
	echo "
<title>�������� ��������� | $name_site</title>";
}
function right()
{
}
require ("theme/$theme/$theme.htm");
?>